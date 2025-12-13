<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetRequest;
use App\Models\Pet;
use App\Models\Category;
use App\Models\PetImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PetController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     * Public page - semua orang bisa lihat pets yang available
     */
    public function index(Request $request)
    {
        $query = Pet::with(['shelter', 'category', 'images'])
            ->where('is_available', true);

        $categoryName = null;

        // Filter by category slug if provided (include subcategories if parent selected)
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $categoryIds = [$category->id];
                // Include child categories when a parent (e.g., 'other') is selected
                if (method_exists($category, 'children')) {
                    $childIds = $category->children()->pluck('id')->all();
                    if (!empty($childIds)) {
                        $categoryIds = array_merge($categoryIds, $childIds);
                    }
                }
                $query->whereIn('category_id', $categoryIds);
                $categoryName = $category->name;
            }
        }

        // Filter by size if provided
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        // Filter by age range
        if ($request->filled('age')) {
            switch ($request->age) {
                case 'young':
                    $query->whereRaw('(age_years * 12 + age_months) <= 24'); // 0 – 24 months (0 – 2 years)
                    break;
                case 'adult':
                    $query->whereRaw('(age_years * 12 + age_months) BETWEEN 25 AND 84'); // 25 – 84 months (> 2 – 7 years)
                    break;
                case 'senior':
                    $query->whereRaw('(age_years * 12 + age_months) > 84'); // 85+ months (8+ years)
                    break;
            }
        }

        // Filter by gender if provided
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Search by name or breed
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('breed', 'like', "%{$search}%");
            });
        }

        $pets = $query->latest()->paginate(12);

        // Append query parameters to pagination links
        $pets->appends($request->all());

        return view('pets.index', compact('pets', 'categoryName'));
    }

    /**
     * Show the form for creating a new resource.
     * Hanya shelter dan admin yang bisa access
     */
    public function create()
    {
        $this->authorize('create', Pet::class);

        $categories = Category::all(); // All categories including subcategories for detailed selection
        return view('pets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * Handle form submission dan file upload
     */
    public function store(PetRequest $request)
    {
        $this->authorize('create', Pet::class);

        // Shelter user must have shelter profile
        if (!Auth::user()->shelter) {
            return redirect()->route('dashboard')
                ->with('error', 'You must complete your shelter profile before adding pets.');
        }

        $shelterId = Auth::user()->shelter->id;

        // Create pet record
        $pet = Pet::create([
            'shelter_id' => $shelterId,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'breed' => $request->breed,
            'color' => $request->color,
            'age_years' => $request->age_years,
            'age_months' => $request->age_months,
            'size' => $request->size,
            'gender' => $request->gender,
            'description' => $request->description,
            'medical_history' => $request->medical_history,
            'vaccination_status' => $request->vaccination_status,
            'is_neutered' => $request->boolean('is_neutered'),
            'is_house_trained' => $request->boolean('is_house_trained'),
            'good_with_kids' => $request->boolean('good_with_kids'),
            'good_with_pets' => $request->boolean('good_with_pets'),
            'adoption_fee' => $request->adoption_fee,
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = $pet->id . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->storeAs('pets', $filename, 'public');

                PetImage::create([
                    'pet_id' => $pet->id,
                    'image_path' => 'pets/' . $filename,
                    'is_primary' => $index === 0, // First image is primary
                ]);

                // Set primary image filename in pets table for dev display
                if ($index === 0) {
                    $pet->update(['image' => $filename]);
                }
            }
        }

        return redirect()->route('pets.manage')
            ->with('success', 'Pet "' . $pet->name . '" has been successfully created!');
    }

    /**
     * Display the specified resource.
     * Public page - detail pet untuk adopter
     */
    public function show(Pet $pet)
    {
        $pet->load(['shelter', 'category', 'images']);

        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     * Hanya owner shelter atau admin
     */
    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);

        $categories = Category::all();
        return view('pets.edit', compact('pet', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * Handle update dan replace images jika ada
     */
    public function update(PetRequest $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        // Update pet data
        $pet->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'breed' => $request->breed,
            'color' => $request->color,
            'age_years' => $request->age_years,
            'age_months' => $request->age_months,
            'size' => $request->size,
            'gender' => $request->gender,
            'description' => $request->description,
            'medical_history' => $request->medical_history,
            'vaccination_status' => $request->vaccination_status,
            'is_neutered' => $request->boolean('is_neutered'),
            'is_house_trained' => $request->boolean('is_house_trained'),
            'good_with_kids' => $request->boolean('good_with_kids'),
            'good_with_pets' => $request->boolean('good_with_pets'),
            'adoption_fee' => $request->adoption_fee,
        ]);

        // Handle new image uploads if provided
        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($pet->images as $oldImage) {
                if (!empty($oldImage->image_path)) {
                    Storage::disk('public')->delete($oldImage->image_path);
                } else {
                    // Legacy cleanup if filename was used
                    Storage::disk('public')->delete('pets/' . ($oldImage->filename ?? ''));
                }
                $oldImage->delete();
            }

            // Upload new images
            foreach ($request->file('images') as $index => $image) {
                $filename = $pet->id . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->storeAs('pets', $filename, 'public');

                PetImage::create([
                    'pet_id' => $pet->id,
                    'image_path' => 'pets/' . $filename,
                    'is_primary' => $index === 0,
                ]);

                // Update primary image filename for dev display
                if ($index === 0) {
                    $pet->update(['image' => $filename]);
                }
            }
        }

        return redirect()->route('pets.show', $pet)
            ->with('success', 'Pet information has been updated successfully!');
    }

    /**
     * Toggle pet availability
     * Soft delete alternative - toggle between available and hidden
     */
    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        // Toggle availability
        $newStatus = !$pet->is_available;
        $pet->update(['is_available' => $newStatus]);

        $message = $newStatus
            ? 'Pet "' . $pet->name . '" is now visible for adoption.'
            : 'Pet "' . $pet->name . '" is now hidden from listings.';

        return redirect()->route('pets.manage')
            ->with('success', $message);
    }

    /**
     * Show pets management page for shelter
     * Shelter dashboard untuk manage pets mereka
     */
    public function manage()
    {
        $this->authorize('create', Pet::class); // Same permission as create

        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin can see all pets
            $pets = Pet::with(['shelter', 'category', 'images'])->latest()->paginate(10);
        } else {
            // Shelter can only see their pets
            // Check if shelter relationship exists
            if (!$user->shelter) {
                return redirect()->route('dashboard')
                    ->with('error', 'You must complete your shelter profile before managing pets.');
            }

            $pets = Pet::with(['category', 'images'])
                ->where('shelter_id', $user->shelter->id)
                ->latest()
                ->paginate(10);
        }

        return view('pets.manage', compact('pets'));
    }
}
