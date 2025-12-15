<x-app-layout>
    <div class="min-h-screen bg-background-primary py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Success Header -->
                <div class="bg-accent-green px-8 py-8 text-center">
                    <svg class="w-16 h-16 text-white mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <h1 class="text-2xl font-bold text-white">{{ __('sponsorships.success.thank_you') }}</h1>
                </div>

                <!-- Donation Details -->
                <div class="p-8">
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.transaction_id') ?? 'Transaction ID' }}</span>
                            <span class="font-mono text-sm text-text-primary">{{ $sponsorship->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.amount') ?? 'Amount' }}</span>
                            <span class="font-bold text-xl text-accent-green">
                                Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.shelter') ?? 'Shelter' }}</span>
                            <span class="font-semibold text-text-primary">{{ $sponsorship->shelter->name }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.date') ?? 'Date' }}</span>
                            <span
                                class="text-text-primary">{{ $sponsorship->paid_at?->format('d M Y, H:i') ?? now()->format('d M Y, H:i') }}</span>
                        </div>
                        @if ($sponsorship->message)
                            <div class="py-2">
                                <span class="text-text-secondary block mb-1">Message</span>
                                <p class="text-text-primary italic">"{{ $sponsorship->message }}"</p>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-background-secondary">
                        <a href="{{ route('shelters.show', $sponsorship->shelter) }}"
                            class="px-6 py-3 bg-accent-red text-white font-semibold rounded-lg hover:opacity-90 transition text-center">
                            {{ __('messages.view') }} {{ __('messages.shelters') }}
                        </a>
                        <a href="{{ route('pets.index') }}"
                            class="px-6 py-3 border-2 border-accent-red text-accent-red font-semibold rounded-lg hover:bg-accent-red hover:text-white transition text-center">
                            {{ __('sponsorships.success.browse_pets') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
