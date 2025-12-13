<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionRequest;
use App\Models\Adoption;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdoptionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display adoption requests for shelter
     * Shelter sees their pets' requests only
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Adoption::class);

        $user = Auth::user();

        // Build query for shelter's adoption requests
        $query = Adoption::with(['pet.category', 'pet.shelter', 'user'])
            ->whereHas('pet', function ($q) use ($user) {
                $q->where('shelter_id', $user->shelter->id);
            });

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $adoptions = $query->latest()->paginate(15);

        return view('adoptions.index', compact('adoptions'));
    }

    /**
     * Show adoption request form for a specific pet
     */
    public function create(Pet $pet)
    {
        $this->authorize('create', Adoption::class);

        // Check if pet is available
        if (!$pet->is_available) {
            return redirect()->route('pets.show', $pet)
                ->with('error', 'This pet is no longer available for adoption.');
        }

        // Check if user already has pending request for this pet
        $existingRequest = Adoption::where('pet_id', $pet->id)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingRequest) {
            return redirect()->route('adoptions.show', $existingRequest)
                ->with('info', 'You already have a ' . $existingRequest->status . ' request for this pet.');
        }

        $pet->load(['category', 'shelter', 'images']);
        return view('adoptions.create', compact('pet'));
    }

    /**
     * Store adoption request
     */
    public function store(AdoptionRequest $request)
    {
        $pet = Pet::findOrFail($request->pet_id);

        // Double-check availability
        if (!$pet->is_available) {
            return redirect()->route('pets.show', $pet)
                ->with('error', 'This pet is no longer available for adoption.');
        }

        $adoption = Adoption::create([
            'pet_id' => $pet->id,
            'user_id' => Auth::id(),
            'shelter_id' => $pet->shelter_id,
            'status' => 'pending',
            'reason' => $request->reason,
            'experience' => $request->experience,
            'housing_type' => $request->housing_type,
            'has_other_pets' => $request->boolean('has_other_pets'),
            'other_pets_details' => $request->other_pets_details,
            'has_children' => $request->boolean('has_children'),
            'children_ages' => $request->children_ages,
            'phone' => $request->phone,
            'address' => $request->address,
            'references' => $request->references,
        ]);

        // TODO: Send email notification to shelter

        return redirect()->route('adoptions.show', $adoption)
            ->with('success', 'Your adoption request has been submitted! The shelter will review it soon.');
    }

    /**
     * Display adoption request details
     */
    public function show(Adoption $adoption)
    {
        $this->authorize('view', $adoption);

        $adoption->load(['pet.category', 'pet.images', 'pet.shelter', 'user']);

        return view('adoptions.show', compact('adoption'));
    }

    /**
     * Update adoption status (approve/reject)
     * Only shelter owner or admin can update
     */
    public function update(Request $request, Adoption $adoption)
    {
        $this->authorize('update', $adoption);

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500',
        ]);

        $adoption->update([
            'status' => $validated['status'],
            'rejection_reason' => $validated['rejection_reason'] ?? null,
            'reviewed_at' => now(),
        ]);

        // If approved, mark pet as unavailable
        if ($validated['status'] === 'approved') {
            $adoption->pet->update(['is_available' => false]);
        }

        // TODO: Send email notification to adopter

        $message = $validated['status'] === 'approved'
            ? 'Adoption request approved! The adopter will be notified.'
            : 'Adoption request rejected.';

        return redirect()->route('adoptions.show', $adoption)
            ->with('success', $message);
    }

    /**
     * Cancel adoption request (adopter only)
     */
    public function destroy(Adoption $adoption)
    {
        $this->authorize('delete', $adoption);

        $adoption->update(['status' => 'cancelled']);

        return redirect()->route('pets.show', $adoption->pet)
            ->with('success', 'Your adoption request has been cancelled.');
    }

    /**
     * Show adopter's own adoption requests
     */
    public function myRequests()
    {
        $this->authorize('viewOwn', Adoption::class);

        $adoptions = Adoption::with(['pet.category', 'pet.shelter', 'pet.images'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('adoptions.my-requests', compact('adoptions'));
    }
}
