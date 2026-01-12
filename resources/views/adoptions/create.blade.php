<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-text-primary mb-2">{{ __('adoptions.create.title') }}</h1>
                <p class="text-text-secondary">{{ __('adoptions.create.subtitle') }} {{ $pet->name }}</p>
            </div>

            <!-- Pet Summary Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex gap-4">
                    @php
                        $img = null;
                        if (!empty($pet->image)) {
                            $img = str_starts_with($pet->image, 'http')
                                ? $pet->image
                                : asset('storage/pets/' . $pet->image);
                        } elseif ($pet->images->first()?->image_path) {
                            $img = asset('storage/' . $pet->images->first()->image_path);
                        }
                    @endphp

                    @if ($img)
                        <img src="{{ $img }}" alt="{{ $pet->name }}"
                            class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                    @endif

                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-text-primary mb-2">{{ $pet->name }}</h2>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-text-secondary">
                            <p><span class="font-semibold">{{ __('messages.category') }}:</span>
                                {{ $pet->category->name }}</p>
                            <p><span class="font-semibold">{{ __('pets.show.age') }}:</span> {{ $pet->formatted_age }}
                            </p>
                            <p><span class="font-semibold">{{ __('pets.show.size') }}:</span>
                                {{ ucfirst($pet->size) }}</p>
                            <p><span class="font-semibold">{{ __('messages.shelter') }}:</span>
                                {{ $pet->shelter->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adoption Form -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form method="POST" action="{{ route('adoptions.store') }}">
                    @csrf
                    <input type="hidden" name="pet_id" value="{{ $pet->id }}">

                    <div class="p-6 space-y-6">
                        <!-- Contact Information -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">
                                {{ __('adoptions.create.form.contact_info') }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.phone') }}
                                        *</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary"
                                        placeholder="+62 812-3456-7890" required>
                                    @error('phone')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary">Email</label>
                                    <input type="email" value="{{ auth()->user()->email }}"
                                        class="mt-1 w-full rounded-md border border-background-secondary bg-gray-50"
                                        disabled>
                                    <p class="text-xs text-text-muted mt-1">{{ __('messages.from_account') }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label
                                    class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.address') }}
                                    *</label>
                                <textarea name="address" rows="2" class="mt-1 w-full rounded-md border border-background-secondary"
                                    placeholder="{{ __('adoptions.create.form.address_placeholder') }}" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Why Adopt This Pet -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">
                                {{ __('adoptions.create.form.about') }}</h2>
                            <div>
                                <label
                                    class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.about') }}
                                    {{ $pet->name }}? *</label>
                                <p class="text-xs text-text-muted mb-2">{{ __('adoptions.create.form.reason_hint') }}
                                </p>
                                <textarea name="reason" rows="5" class="mt-1 w-full rounded-md border border-background-secondary"
                                    placeholder="{{ __('adoptions.create.form.reason_placeholder') }}" required>{{ old('reason') }}</textarea>
                                @error('reason')
                                    <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Pet Experience -->
                        <div>
                            <label
                                class="block text-sm font-medium text-text-secondary">{{ __('adoptions.show.pet_experience') }}
                                *</label>
                            <textarea name="experience" rows="3" class="mt-1 w-full rounded-md border border-background-secondary"
                                placeholder="{{ __('adoptions.create.form.experience_placeholder') }}" required>{{ old('experience') }}</textarea>
                            @error('experience')
                                <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Living Situation -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">
                                {{ __('adoptions.create.form.living_situation') }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.housing_type') }}
                                        *</label>
                                    <select name="housing_type"
                                        class="mt-1 w-full rounded-md border border-background-secondary" required>
                                        <option value="">{{ __('messages.select') }}</option>
                                        <option value="house" {{ old('housing_type') === 'house' ? 'selected' : '' }}>
                                            {{ __('adoptions.create.form.housing_options.house') }}</option>
                                        <option value="apartment"
                                            {{ old('housing_type') === 'apartment' ? 'selected' : '' }}>
                                            {{ __('adoptions.create.form.housing_options.apartment') }}
                                        </option>
                                        <option value="farm" {{ old('housing_type') === 'farm' ? 'selected' : '' }}>
                                            {{ __('adoptions.create.form.housing_options.farm') }}</option>
                                        <option value="other" {{ old('housing_type') === 'other' ? 'selected' : '' }}>
                                            {{ __('adoptions.create.form.housing_options.other') }}</option>
                                    </select>
                                    @error('housing_type')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Other Pets -->
                        <div>
                            <label
                                class="block text-sm font-medium text-text-secondary mb-2">{{ __('adoptions.create.form.other_pets') }}
                                *</label>
                            <div class="space-y-2">
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="has_other_pets" value="1"
                                        {{ old('has_other_pets') == '1' ? 'checked' : '' }}
                                        onchange="document.getElementById('other_pets_details').classList.remove('hidden')">
                                    <span class="text-sm">{{ __('messages.yes') }}</span>
                                </label>
                                <label class="inline-flex items-center gap-2 ml-4">
                                    <input type="radio" name="has_other_pets" value="0"
                                        {{ old('has_other_pets') == '0' ? 'checked' : '' }}
                                        onchange="document.getElementById('other_pets_details').classList.add('hidden')">
                                    <span class="text-sm">{{ __('messages.no') }}</span>
                                </label>
                            </div>
                            @error('has_other_pets')
                                <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div id="other_pets_details"
                                class="mt-3 {{ old('has_other_pets') == '1' ? '' : 'hidden' }}">
                                <label
                                    class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.other_pets_details_label') }}</label>
                                <textarea name="other_pets_details" rows="2" class="mt-1 w-full rounded-md border border-background-secondary"
                                    placeholder="{{ __('adoptions.create.form.other_pets_placeholder') }}">{{ old('other_pets_details') }}</textarea>
                                @error('other_pets_details')
                                    <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Children -->
                        <div>
                            <label
                                class="block text-sm font-medium text-text-secondary mb-2">{{ __('adoptions.create.form.children') }}
                                *</label>
                            <div class="space-y-2">
                                <label class="inline-flex items-center gap-2">
                                    <input type="radio" name="has_children" value="1"
                                        {{ old('has_children') == '1' ? 'checked' : '' }}
                                        onchange="document.getElementById('children_ages_field').classList.remove('hidden')">
                                    <span class="text-sm">{{ __('messages.yes') }}</span>
                                </label>
                                <label class="inline-flex items-center gap-2 ml-4">
                                    <input type="radio" name="has_children" value="0"
                                        {{ old('has_children') == '0' ? 'checked' : '' }}
                                        onchange="document.getElementById('children_ages_field').classList.add('hidden')">
                                    <span class="text-sm">{{ __('messages.no') }}</span>
                                </label>
                            </div>
                            @error('has_children')
                                <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div id="children_ages_field"
                                class="mt-3 {{ old('has_children') == '1' ? '' : 'hidden' }}">
                                <label
                                    class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.children_ages') }}</label>
                                <input type="text" name="children_ages" value="{{ old('children_ages') }}"
                                    class="mt-1 w-full rounded-md border border-background-secondary"
                                    placeholder="e.g., 5, 8, 12 years old">
                                @error('children_ages')
                                    <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- References -->
                        <div>
                            <label
                                class="block text-sm font-medium text-text-secondary">{{ __('adoptions.create.form.references') }}</label>
                            <p class="text-xs text-text-muted mb-2">{{ __('adoptions.show.references') }}</p>
                            <textarea name="references" rows="2" class="mt-1 w-full rounded-md border border-background-secondary"
                                placeholder="{{ __('adoptions.create.form.references_placeholder') }}">{{ old('references') }}</textarea>
                            @error('references')
                                <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-background-secondary">
                            <a href="{{ route('pets.show', $pet) }}"
                                class="px-4 py-2 rounded-md border border-background-secondary bg-white text-text-secondary hover:bg-background-primary">
                                {{ __('messages.cancel') }}
                            </a>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                                {{ __('adoptions.create.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
