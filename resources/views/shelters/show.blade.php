<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ route('shelters.index') }}"
                    class="inline-flex items-center text-text-secondary hover:text-text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Browse Shelters
                </a>
            </div>

            {{-- Shelter Header --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="p-8">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <h1 class="text-3xl font-bold text-text-primary">{{ $shelter->name }}</h1>
                                @if ($shelter->is_verified)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Verified Shelter
                                    </span>
                                @endif
                            </div>
                            @if ($shelter->description)
                                <p class="text-text-secondary text-lg mb-4">{{ $shelter->description }}</p>
                            @endif

                            {{-- Sponsor Button - Only for verified shelters and adopter role --}}
                            @if ($shelter->is_verified)
                                @auth
                                    @if (auth()->user()->role === 'adopter')
                                        <a href="{{ route('sponsorships.create', $shelter) }}"
                                            class="inline-flex items-center px-6 py-3 bg-accent-green text-white font-semibold rounded-lg hover:opacity-90 transition">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Sponsor This Shelter
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6 pt-6 border-t border-gray-200">
                        {{-- Address --}}
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-text-secondary mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Address</p>
                                <p class="text-text-primary">{{ $shelter->address }}</p>
                            </div>
                        </div>

                        {{-- Contact --}}
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-text-secondary mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Contact</p>
                                <p class="text-text-primary">{{ $shelter->email }}</p>
                                <p class="text-text-primary">{{ $shelter->phone }}</p>
                            </div>
                        </div>

                        {{-- Website --}}
                        @if ($shelter->website)
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-text-secondary mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Website</p>
                                    <a href="{{ $shelter->website }}" target="_blank"
                                        class="text-accent-blue hover:underline">
                                        {{ parse_url($shelter->website, PHP_URL_HOST) }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pets Section --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-text-primary">Available Pets ({{ $shelter->pets->count() }})</h2>
                </div>

                @if ($shelter->pets->count() > 0)
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($shelter->pets as $pet)
                                <a href="{{ route('pets.show', $pet) }}"
                                    class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                    {{-- Pet Image --}}
                                    <div class="aspect-square overflow-hidden bg-gray-100">
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
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-gray-400 group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Pet Info --}}
                                    <div class="p-4">
                                        <h3
                                            class="text-lg font-semibold text-text-primary group-hover:text-accent-blue">
                                            {{ $pet->name }}
                                        </h3>
                                        <p class="text-sm text-text-secondary">{{ $pet->category->name }}</p>
                                        <div class="flex items-center gap-2 mt-2 text-sm text-text-secondary">
                                            <span>{{ $pet->formatted_age }}</span>
                                            <span>•</span>
                                            <span class="capitalize">{{ $pet->size }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No pets available</h3>
                        <p class="mt-1 text-sm text-gray-500">This shelter doesn't have any pets listed at the moment.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
