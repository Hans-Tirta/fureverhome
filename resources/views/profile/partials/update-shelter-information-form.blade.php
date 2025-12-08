<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Shelter Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your shelter's information and contact details.") }}
        </p>

        @if (!auth()->user()->shelter->is_verified)
            <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                <p class="text-sm text-yellow-800">
                    <strong>Verification Pending:</strong> Your shelter is awaiting admin approval. You'll be able to
                    post pets once verified.
                </p>
            </div>
        @else
            <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-md">
                <p class="text-sm text-green-800 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <strong>Verified Shelter</strong>
                </p>
            </div>
        @endif
    </header>

    <form method="post" action="{{ route('profile.shelter.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="shelter_name" :value="__('Shelter Name')" />
            <x-text-input id="shelter_name" name="shelter_name" type="text" class="mt-1 block w-full"
                :value="old('shelter_name', auth()->user()->shelter->name)" required />
            <x-input-error class="mt-2" :messages="$errors->get('shelter_name')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" rows="2"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>{{ old('address', auth()->user()->shelter->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', auth()->user()->shelter->phone)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="shelter_email" :value="__('Shelter Contact Email')" />
            <x-text-input id="shelter_email" name="shelter_email" type="email" class="mt-1 block w-full"
                :value="old('shelter_email', auth()->user()->shelter->email)" required />
            <p class="text-xs text-gray-500 mt-1">This will be displayed publicly for adoption inquiries.</p>
            <x-input-error class="mt-2" :messages="$errors->get('shelter_email')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" rows="3"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', auth()->user()->shelter->description) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Brief description of your shelter and mission.</p>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="website" :value="__('Website')" />
            <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="old('website', auth()->user()->shelter->website)"
                placeholder="https://" />
            <x-input-error class="mt-2" :messages="$errors->get('website')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'shelter-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
