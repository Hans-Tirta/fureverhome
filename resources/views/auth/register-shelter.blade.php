<x-guest-layout>
    <form method="POST" action="{{ route('register.shelter') }}">
        @csrf

        <!-- Account Information -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Account Information</h3>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Your Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Shelter Information -->
        <div class="mb-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Shelter Information</h3>

            <!-- Shelter Name -->
            <div>
                <x-input-label for="shelter_name" :value="__('Shelter Name')" />
                <x-text-input id="shelter_name" class="block mt-1 w-full" type="text" name="shelter_name"
                    :value="old('shelter_name')" required />
                <x-input-error :messages="$errors->get('shelter_name')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <textarea id="address" name="address" rows="2"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    required>{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Shelter Email -->
            <div class="mt-4">
                <x-input-label for="shelter_email" :value="__('Shelter Contact Email')" />
                <x-text-input id="shelter_email" class="block mt-1 w-full" type="email" name="shelter_email"
                    :value="old('shelter_email')" required />
                <p class="text-xs text-gray-500 mt-1">This will be displayed publicly for adoption inquiries.</p>
                <x-input-error :messages="$errors->get('shelter_email')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description (Optional)')" />
                <textarea id="description" name="description" rows="3"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Brief description of your shelter and mission.</p>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Website -->
            <div class="mt-4">
                <x-input-label for="website" :value="__('Website (Optional)')" />
                <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')"
                    placeholder="https://" />
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>
        </div>

        <!-- Verification Notice -->
        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-md">
            <p class="text-sm text-blue-800">
                <strong>Note:</strong> Your shelter registration will be reviewed by our admin team. You'll be able to
                post pets once your account is verified.
            </p>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <div class="flex items-center gap-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('Register as Adopter') }}
                </a>
                <x-primary-button>
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
