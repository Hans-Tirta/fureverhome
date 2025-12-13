<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('shelters.show', $shelter) }}"
                    class="inline-flex items-center text-text-secondary hover:text-text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Shelter Profile
                </a>
            </div>

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-text-primary mb-2">Support {{ $shelter->name }}</h1>
                <p class="text-text-secondary">Your donation helps care for all animals at this shelter</p>
            </div>

            <!-- Shelter Summary Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div
                        class="w-16 h-16 bg-accent-red bg-opacity-10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-accent-red" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h2 class="text-xl font-bold text-text-primary">{{ $shelter->name }}</h2>
                            @if ($shelter->is_verified)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Verified
                                </span>
                            @endif
                        </div>

                        @if ($shelter->description)
                            <p class="text-text-secondary text-sm mb-3">{{ Str::limit($shelter->description, 120) }}</p>
                        @endif

                        <div class="flex flex-wrap gap-4 text-sm text-text-secondary">
                            @if ($shelter->address)
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ Str::limit($shelter->address, 50) }}</span>
                                </div>
                            @endif

                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <span>{{ $shelter->pets->count() }} animals</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation Form -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form method="POST" action="{{ route('sponsorships.store') }}" id="sponsorshipForm">
                    @csrf
                    <input type="hidden" name="shelter_id" value="{{ $shelter->id }}">

                    <div class="p-6 space-y-6">

                        <!-- Donation Amount -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Donation Amount</h2>

                            <!-- Preset Amounts -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                @foreach ([50000, 100000, 250000, 500000] as $preset)
                                    <button type="button" onclick="setAmount({{ $preset }}, this)"
                                        class="preset-amount px-4 py-3 border-2 border-background-secondary rounded-lg text-text-primary font-semibold hover:border-accent-red hover:bg-accent-red hover:bg-opacity-10 transition-colors">
                                        Rp {{ number_format($preset, 0, ',', '.') }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Custom Amount -->
                            <div>
                                <label class="block text-sm font-medium text-text-secondary mb-2">
                                    Or enter custom amount (Minimum Rp 1.000) *
                                </label>
                                <input type="number" id="amountInput" name="amount" value="{{ old('amount') }}"
                                    min="1000" step="1000"
                                    class="w-full rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50"
                                    placeholder="Enter amount (e.g., 50000)" required>
                                @error('amount')
                                    <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-text-muted mt-1">Minimum donation: Rp 1.000</p>
                            </div>
                        </div>

                        <!-- Message (Optional) -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Message (Optional)</h2>
                            <div>
                                <label class="block text-sm font-medium text-text-secondary mb-2">
                                    Leave a message for the shelter
                                </label>
                                <textarea name="message" rows="4"
                                    class="mt-1 w-full rounded-md border border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50"
                                    placeholder="Share your support message...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-text-muted mt-1">Your message will be visible to the shelter</p>
                            </div>
                        </div>

                        <!-- Anonymous Option -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Privacy</h2>
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" name="is_anonymous" value="1"
                                    {{ old('is_anonymous') ? 'checked' : '' }}
                                    class="mt-1 rounded border-background-secondary text-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">
                                <div class="flex-1">
                                    <span
                                        class="block text-sm font-medium text-text-primary group-hover:text-accent-red">
                                        Make my donation anonymous
                                    </span>
                                    <span class="block text-xs text-text-secondary mt-1">
                                        Your name will be hidden from public donation lists, but the shelter will still
                                        see your information
                                    </span>
                                </div>
                            </label>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-background-secondary">
                            <a href="{{ route('shelters.show', $shelter) }}"
                                class="px-4 py-2 rounded-md border border-background-secondary bg-white text-text-secondary hover:bg-background-primary">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Security Badge -->
            <div class="mt-6 text-center">
                <div class="inline-flex items-center gap-2 text-sm text-text-secondary">
                    <svg class="w-5 h-5 text-accent-green" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Secure payment powered by Midtrans</span>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            // Function to set preset amount
            function setAmount(amount, button) {
                // Set the input value
                document.getElementById('amountInput').value = amount;

                // Visual feedback: highlight selected button
                document.querySelectorAll('.preset-amount').forEach(btn => {
                    btn.classList.remove('border-accent-red', 'bg-accent-red', 'bg-opacity-10');
                    btn.classList.add('border-background-secondary');
                });

                // Highlight the clicked button
                button.classList.remove('border-background-secondary');
                button.classList.add('border-accent-red', 'bg-accent-red', 'bg-opacity-10');
            }
        </script>
    @endpush
</x-app-layout>
