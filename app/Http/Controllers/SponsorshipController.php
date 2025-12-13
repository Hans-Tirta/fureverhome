<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SponsorshipRequest;
use App\Models\Shelter;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class SponsorshipController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Show the sponsorship form for a specific shelter
     */
    public function create(Shelter $shelter)
    {
        // Ensure shelter exists and is verified
        if (!$shelter->is_verified) {
            return redirect()->back()
                ->with('error', 'This shelter is not verified yet.');
        }

        return view('sponsorships.create', compact('shelter'));
    }

    /**
     * Process the sponsorship payment and initiate Midtrans transaction
     */
    public function store(SponsorshipRequest $request)
    {
        $validated = $request->validated();

        try {
            // Create sponsorship record with pending status
            $sponsorship = Sponsorship::create([
                'user_id' => Auth::id(),
                'shelter_id' => $validated['shelter_id'],
                'amount' => $validated['amount'],
                'message' => $validated['message'] ?? null,
                'is_anonymous' => $request->boolean('is_anonymous'),
                'payment_status' => 'pending',
                'payment_method' => 'midtrans',
            ]);

            // Generate unique order ID
            $orderId = 'SPONSOR-' . $sponsorship->id . '-' . time();

            // Prepare transaction details for Midtrans
            $transactionDetails = [
                'order_id' => $orderId,
                'gross_amount' => (int) $validated['amount'],
            ];

            // Customer details
            $customerDetails = [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ];

            // Item details
            $itemDetails = [
                [
                    'id' => 'DONATION',
                    'price' => (int) $validated['amount'],
                    'quantity' => 1,
                    'name' => 'Donation to ' . Shelter::find($validated['shelter_id'])->name,
                ],
            ];

            // Midtrans transaction parameters
            $params = [
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
                'item_details' => $itemDetails,
            ];

            // Get Snap payment URL
            $snapToken = Snap::getSnapToken($params);

            // Update sponsorship with transaction ID
            $sponsorship->update(['transaction_id' => $orderId]);

            // Return snap token to frontend
            return response()->json([
                'snap_token' => $snapToken,
                'sponsorship_id' => $sponsorship->id,
            ]);
        } catch (\Exception $e) {
            // Log error and return error response
            \Log::error('Midtrans Snap Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to initiate payment. Please try again.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle Midtrans payment notification callback
     * This endpoint is called by Midtrans server to notify payment status
     */
    public function notification(Request $request)
    {
        try {
            // Get notification data from Midtrans
            $notif = new \Midtrans\Notification();

            $transactionStatus = $notif->transaction_status;
            $orderId = $notif->order_id;
            $fraudStatus = $notif->fraud_status;

            // Find sponsorship by transaction ID
            $sponsorship = Sponsorship::where('transaction_id', $orderId)->first();

            if (!$sponsorship) {
                return response()->json(['message' => 'Sponsorship not found'], 404);
            }

            // Update payment status based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $sponsorship->update([
                        'payment_status' => 'success',
                        'paid_at' => now(),
                    ]);
                }
            } elseif ($transactionStatus == 'settlement') {
                $sponsorship->update([
                    'payment_status' => 'success',
                    'paid_at' => now(),
                ]);
            } elseif ($transactionStatus == 'pending') {
                $sponsorship->update([
                    'payment_status' => 'pending',
                ]);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $sponsorship->update([
                    'payment_status' => 'failed',
                ]);
            }

            return response()->json(['message' => 'Notification processed']);
        } catch (\Exception $e) {
            \Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }

    /**
     * Show sponsorship success page
     */
    public function success($id)
    {
        $sponsorship = Sponsorship::with('shelter', 'user')->findOrFail($id);

        // Verify that user owns this sponsorship
        if ($sponsorship->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        return view('sponsorships.success', compact('sponsorship'));
    }

    /**
     * Show sponsorship failed page
     */
    public function failed($id)
    {
        $sponsorship = Sponsorship::with('shelter')->findOrFail($id);

        // Verify that user owns this sponsorship
        if ($sponsorship->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        return view('sponsorships.failed', compact('sponsorship'));
    }
}
