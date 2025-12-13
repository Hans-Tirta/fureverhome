<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShelterController extends Controller
{
    /**
     * Display a listing of all shelters.
     */
    public function index(Request $request): View
    {
        $query = Shelter::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Load pets count for each shelter
        $query->withCount([
            'pets' => function ($q) {
                $q->where('is_available', true);
            }
        ]);

        // Sort: Verified first, then alphabetically by name
        $shelters = $query->orderBy('is_verified', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(12)
            ->withQueryString();

        return view('shelters.index', compact('shelters'));
    }

    /**
     * Display the specified shelter's public profile.
     */
    public function show(Shelter $shelter): View
    {
        // Load shelter with user and pets (only available pets)
        $shelter->load([
            'user',
            'pets' => function ($query) {
                $query->where('is_available', true)->latest()->take(12);
            }
        ]);

        return view('shelters.show', compact('shelter'));
    }
}
