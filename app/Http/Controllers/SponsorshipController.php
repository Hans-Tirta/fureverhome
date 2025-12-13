<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
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
    public function store(Request $request)
    {
        // Payment processing implementation
        return response()->json(['message' => 'Sponsorship payment endpoint']);
    }

    /**
     * Handle Midtrans payment notification callback
     * This endpoint is called by Midtrans server to notify payment status
     */
    public function notification(Request $request)
    {
        // Midtrans webhook handler
        return response()->json(['message' => 'Notification received']);
    }

    /**
     * Show sponsorship success page
     */
    public function success($id)
    {
        // Display success message to user
        return view('sponsorships.success');
    }

    /**
     * Show sponsorship failed page
     */
    public function failed($id)
    {
        // Display failure message to user
        return view('sponsorships.failed');
    }
}
