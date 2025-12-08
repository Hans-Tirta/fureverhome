<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-text-primary mb-2">Articles & Guides</h1>
                <p class="text-text-secondary">Learn about pet care, adoption tips, and more</p>
            </div>

            <!-- Coming Soon Placeholder -->
            @if ($articles->count() === 0)
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-20 h-20 text-text-muted mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-text-primary mb-2">Articles Coming Soon</h3>
                    <p class="text-text-secondary mb-6">We're working on creating helpful content about pet care and
                        adoption. Check back soon!</p>
                    <a href="{{ route('pets.index') }}"
                        class="inline-block px-6 py-3 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                        Browse Available Pets
                    </a>
                </div>
            @else
                <!-- Articles Grid (for future when articles exist) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <!-- Article Card Content (to be implemented) -->
                            <a href="{{ route('articles.show', $article) }}">
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-text-primary mb-2">{{ $article->title }}</h3>
                                    <p class="text-text-secondary text-sm">{{ Str::limit($article->content, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
