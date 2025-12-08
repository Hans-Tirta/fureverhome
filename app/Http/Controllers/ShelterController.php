<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShelterController extends Controller
{
    /**
     * Display the specified shelter's public profile.
     */
    public function show(Shelter $shelter): View
    {
        // Load shelter with user and pets (only available pets)
        $shelter->load(['user', 'pets' => function ($query) {
            $query->where('is_available', true)->latest()->take(12);
        }]);

        return view('shelters.show', compact('shelter'));
    }
}
