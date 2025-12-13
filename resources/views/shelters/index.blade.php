<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-text-primary mb-2">Browse Animal Shelters</h1>
                <p class="text-text-secondary">
                    Discover verified shelters and support their mission to help animals in need
                </p>
            </div>

            {{-- Search Section --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <form method="GET" action="{{ route('shelters.index') }}" class="space-y-4">

                    {{-- Search Bar --}}
                    <div>
                        <label for="search" class="block text-sm font-medium text-text-primary mb-2">
                            Search by name or location
                        </label>
                        <div class="flex gap-3">
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Enter shelter name or location..."
                                class="flex-1 rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">

                            <button type="submit"
                                class="bg-accent-red hover:bg-opacity-90 text-white font-semibold py-2 px-8 rounded-md transition shadow-sm">
                                Search
                            </button>

                            @if (request('search'))
                                <a href="{{ route('shelters.index') }}"
                                    class="bg-text-secondary hover:bg-opacity-90 text-white font-semibold py-2 px-6 rounded-md transition shadow-sm">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>

                </form>
            </div>

            {{-- Results Count --}}
            <div class="mb-6">
                <p class="text-text-secondary">
                    Showing <span class="font-semibold text-text-primary">{{ $shelters->total() }}</span> shelter(s)
                    @if (request('search'))
                        matching "{{ request('search') }}"
                    @endif
                </p>
            </div>

            {{-- Shelter Grid --}}
            @if ($shelters->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($shelters as $shelter)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow flex flex-col">
                            {{-- Shelter Info --}}
                            <div class="p-4 flex flex-col flex-1">
                                <a href="{{ route('shelters.show', $shelter) }}" class="block mb-2">
                                    <div class="flex items-start justify-between gap-2 mb-2">
                                        <h3
                                            class="text-lg font-bold text-text-primary hover:text-accent-red transition">
                                            {{ $shelter->name }}
                                        </h3>
                                    </div>
                                </a>

                                {{-- Description with fixed height --}}
                                <div class="mb-4">
                                    @if ($shelter->description)
                                        <p class="text-sm text-text-secondary line-clamp-4 h-20">
                                            {{ $shelter->description }}
                                        </p>
                                    @else
                                        <p class="text-sm text-text-muted italic h-20 flex items-center">
                                            No description available
                                        </p>
                                    @endif
                                </div>

                                {{-- Location & Pets Info --}}
                                <div class="space-y-2 mb-4">
                                    {{-- Location --}}
                                    <div class="flex items-center text-sm text-text-secondary">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ Str::limit($shelter->address, 40) }}</span>
                                    </div>

                                    {{-- Pets Count --}}
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-text-secondary">
                                            {{ $shelter->pets_count }} {{ Str::plural('pet', $shelter->pets_count) }}
                                        </span>
                                        <span
                                            class="px-2 py-1 bg-background-primary text-text-primary text-xs font-medium rounded">
                                            Available
                                        </span>
                                    </div>
                                </div>

                                {{-- Button pushed to bottom --}}
                                <a href="{{ route('shelters.show', $shelter) }}"
                                    class="block w-full text-center bg-accent-red hover:bg-opacity-90 text-white font-semibold py-2 rounded-md transition mt-auto">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $shelters->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-lg shadow-md p-16 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <svg class="mx-auto h-20 w-20 text-text-muted" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-text-primary mb-3">No Shelters Found</h3>
                        <p class="text-text-secondary mb-8 leading-relaxed">
                            @if (request('search'))
                                We couldn't find any shelters matching "{{ request('search') }}". Try a different
                                search term.
                            @else
                                There are no registered shelters at the moment.
                            @endif
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            @if (request('search'))
                                <a href="{{ route('shelters.index') }}"
                                    class="inline-block bg-accent-red hover:bg-opacity-90 text-white font-semibold py-3 px-8 rounded-md transition shadow-sm">
                                    View All Shelters
                                </a>
                            @endif
                            <a href="{{ route('pets.index') }}"
                                class="inline-block bg-white hover:bg-background-primary text-text-primary font-semibold py-3 px-8 rounded-md transition border border-background-secondary">
                                Browse Pets Instead
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
