<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-text-primary mb-2">Articles & Guides</h1>
                    <p class="text-text-secondary">Learn about pet care, adoption tips, and more</p>
                </div>
                @auth
                    @if (auth()->user()->isAdmin())
                        <div class="flex gap-3">
                            <a href="{{ route('articles.manage') }}"
                                class="px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold">
                                Manage Articles
                            </a>
                            <a href="{{ route('articles.create') }}"
                                class="px-4 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                                Create Article
                            </a>
                        </div>
                    @endif
                @endauth
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
                <!-- Articles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <a href="{{ route('articles.show', $article) }}" class="block">
                                @if ($article->featured_image)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ asset('storage/' . $article->featured_image) }}"
                                            alt="{{ $article->title }}"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-accent-red flex items-center justify-center">
                                        <svg class="w-20 h-20 text-white opacity-70" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-6">
                                    @if ($article->category)
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 mb-2">
                                            {{ $article->category->name }}
                                        </span>
                                    @endif
                                    <h3
                                        class="text-lg font-bold text-text-primary mb-2 hover:text-accent-red transition">
                                        {{ $article->title }}
                                    </h3>
                                    <p class="text-text-secondary text-sm mb-4">
                                        {{ Str::limit(strip_tags($article->content), 120) }}
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-text-muted">
                                        <div class="flex items-center gap-2">
                                            <span>By {{ $article->author->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span>{{ $article->created_at->format('M d, Y') }}</span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                {{ number_format($article->views) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
