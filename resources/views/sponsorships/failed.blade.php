<x-app-layout>
    <div class="min-h-screen bg-background-primary py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Failed Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Failed Header -->
                <div class="bg-accent-red px-8 py-8 text-center">
                    <svg class="w-16 h-16 text-white mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <h1 class="text-2xl font-bold text-white">{{ __('sponsorships.failed.failed') }}</h1>
                </div>

                <!-- Transaction Details -->
                <div class="p-8">
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.transaction_id') }}</span>
                            <span class="font-mono text-sm text-text-primary">{{ $sponsorship->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.amount') }}</span>
                            <span class="font-bold text-xl text-text-primary">
                                Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.shelter') }}</span>
                            <span class="font-semibold text-text-primary">{{ $sponsorship->shelter->name }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-background-secondary">
                            <span class="text-text-secondary">{{ __('messages.status') ?? 'Status' }}</span>
                            <span class="font-semibold text-accent-red">{{ __('sponsorships.failed.status_failed') }}</span>
                        </div>
                    </div>

                    <!-- Error Info -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-text-primary mb-2">{{ __('sponsorships.failed.common_reasons.title') }}</p>
                        <ul class="text-sm text-text-secondary space-y-1 list-disc list-inside">
                            <li>{{ __('sponsorships.failed.common_reasons.insufficient') }}</li>
                            <li>{{ __('sponsorships.failed.common_reasons.cancelled') }}</li>
                            <li>{{ __('sponsorships.failed.common_reasons.declined') }}</li>
                            <li>{{ __('sponsorships.failed.common_reasons.timeout') }}</li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-background-secondary">
                        <a href="{{ route('sponsorships.create', $sponsorship->shelter) }}"
                            class="px-6 py-3 bg-accent-red text-white font-semibold rounded-lg hover:opacity-90 transition text-center">
                            {{ __('sponsorships.failed.try_again') }}
                        </a>
                        <a href="{{ route('shelters.show', $sponsorship->shelter) }}"
                            class="px-6 py-3 border-2 border-accent-red text-accent-red font-semibold rounded-lg hover:bg-accent-red hover:text-white transition text-center">
                            {{ __('sponsorships.failed.back_to_shelter') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
