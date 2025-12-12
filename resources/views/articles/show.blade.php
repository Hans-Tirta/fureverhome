<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button & Admin Actions -->
            <div class="mb-6 flex items-center justify-between">
                <a href="{{ route('articles.index') }}"
                    class="inline-flex items-center text-text-secondary hover:text-text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Articles
                </a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="flex gap-3">
                            <a href="{{ route('articles.edit', $article) }}"
                                class="inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-semibold">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('articles.destroy', $article) }}" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 font-semibold">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Article Content -->
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Featured Image (if exists) -->
                @if ($article->featured_image)
                    <div class="w-full aspect-video overflow-hidden bg-background-secondary">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-8">
                    <!-- Category Badge -->
                    @if ($article->category)
                        <span
                            class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 mb-4">
                            {{ $article->category->name }}
                        </span>
                    @endif

                    <h1 class="text-3xl font-bold text-text-primary mb-4">{{ $article->title }}</h1>

                    <div
                        class="flex items-center gap-4 text-sm text-text-secondary mb-6 pb-4 border-b border-background-secondary">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            By {{ $article->author->name }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $article->created_at->format('F d, Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ number_format($article->views) }} views
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none text-text-primary leading-relaxed">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Author Info -->
                    <div class="mt-8 pt-6 border-t border-background-secondary">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-accent-red to-accent-orange flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($article->author->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-text-primary">{{ $article->author->name }}</p>
                                <p class="text-sm text-text-secondary">Author</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

        </div>
    </div>
</x-app-layout>
