<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display pending shelter verifications.
     */
    public function shelters(Request $request): View
    {
        $status = $request->query('status', 'pending');

        $query = Shelter::with('user');

        if ($status === 'pending') {
            $query->where('is_verified', false);
        } elseif ($status === 'verified') {
            $query->where('is_verified', true);
        }

        $shelters = $query->latest()->paginate(15);

        return view('admin.shelters.index', compact('shelters', 'status'));
    }

    /**
     * Approve a shelter registration.
     */
    public function approveShelter(Shelter $shelter): RedirectResponse
    {
        if ($shelter->is_verified) {
            return redirect()->route('admin.shelters')
                ->with('info', 'Shelter is already verified.');
        }

        $shelter->update(['is_verified' => true]);

        return redirect()->route('admin.shelters')
            ->with('success', "Shelter '{$shelter->name}' has been verified successfully.");
    }
}
