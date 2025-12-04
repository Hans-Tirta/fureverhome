<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-text-primary">Add New Pet</h1>
                <a href="{{ route('pets.manage') }}" class="text-text-secondary hover:text-text-primary">Back to
                    Manage</a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-6">
                        <!-- Basic Info -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Basic Info</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary" required>
                                    @error('name')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Category</label>
                                    <select name="category_id"
                                        class="mt-1 w-full rounded-md border border-background-secondary" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Breed</label>
                                    <input type="text" name="breed" value="{{ old('breed') }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary">
                                    @error('breed')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Color</label>
                                    <input type="text" name="color" value="{{ old('color') }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary">
                                    @error('color')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Gender</label>
                                    <select name="gender"
                                        class="mt-1 w-full rounded-md border border-background-secondary" required>
                                        <option value="">Select gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Age & Size -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Age & Size</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Age (years)</label>
                                    <input type="number" name="age_years" value="{{ old('age_years', 0) }}"
                                        min="0" class="mt-1 w-full rounded-md border border-background-secondary"
                                        required>
                                    @error('age_years')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Age (months)</label>
                                    <input type="number" name="age_months" value="{{ old('age_months', 0) }}"
                                        min="0" max="11"
                                        class="mt-1 w-full rounded-md border border-background-secondary" required>
                                    @error('age_months')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Size</label>
                                    <select name="size"
                                        class="mt-1 w-full rounded-md border border-background-secondary" required>
                                        <option value="">Select size</option>
                                        <option value="small" {{ old('size') == 'small' ? 'selected' : '' }}>Small
                                        </option>
                                        <option value="medium" {{ old('size') == 'medium' ? 'selected' : '' }}>Medium
                                        </option>
                                        <option value="large" {{ old('size') == 'large' ? 'selected' : '' }}>Large
                                        </option>
                                    </select>
                                    @error('size')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Attributes -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Attributes</h2>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <label for="is_neutered" class="inline-flex items-center gap-2 cursor-pointer">
                                    <input id="is_neutered" type="checkbox" name="is_neutered" value="1"
                                        {{ old('is_neutered') ? 'checked' : '' }}>
                                    <span class="text-sm text-text-secondary">Neutered</span>
                                </label>
                                <label for="is_house_trained" class="inline-flex items-center gap-2 cursor-pointer">
                                    <input id="is_house_trained" type="checkbox" name="is_house_trained" value="1"
                                        {{ old('is_house_trained') ? 'checked' : '' }}>
                                    <span class="text-sm text-text-secondary">House Trained</span>
                                </label>
                                <label for="good_with_kids" class="inline-flex items-center gap-2 cursor-pointer">
                                    <input id="good_with_kids" type="checkbox" name="good_with_kids" value="1"
                                        {{ old('good_with_kids') ? 'checked' : '' }}>
                                    <span class="text-sm text-text-secondary">Good with Kids</span>
                                </label>
                                <label for="good_with_pets" class="inline-flex items-center gap-2 cursor-pointer">
                                    <input id="good_with_pets" type="checkbox" name="good_with_pets" value="1"
                                        {{ old('good_with_pets') ? 'checked' : '' }}>
                                    <span class="text-sm text-text-secondary">Good with Other Pets</span>
                                </label>
                            </div>
                        </div>

                        <!-- Description & Health -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Description & Health</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">About the Pet</label>
                                    <textarea name="description" rows="4" class="mt-1 w-full rounded-md border border-background-secondary"
                                        required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Medical
                                        History</label>
                                    <textarea name="medical_history" rows="4" class="mt-1 w-full rounded-md border border-background-secondary">{{ old('medical_history') }}</textarea>
                                    @error('medical_history')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Vaccination
                                        Status</label>
                                    <input type="text" name="vaccination_status"
                                        value="{{ old('vaccination_status') }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary">
                                    @error('vaccination_status')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Adoption Fee -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Adoption Fee</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Fee (IDR)</label>
                                    <input type="number" step="0.01" name="adoption_fee"
                                        value="{{ old('adoption_fee') }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary">
                                    @error('adoption_fee')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Images</h2>
                            <p class="text-sm text-text-secondary mb-2">You can upload multiple images. The first image
                                will be used as the primary display image.</p>
                            <input type="file" name="images[]" multiple accept="image/*"
                                class="w-full rounded-md border border-background-secondary">
                            @error('images')
                                <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-background-secondary">
                            <a href="{{ route('pets.manage') }}"
                                class="px-4 py-2 rounded-md border border-background-secondary bg-white">Cancel</a>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90">Create
                                Pet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
