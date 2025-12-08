<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('articles.index') }}"
                    class="inline-flex items-center text-text-secondary hover:text-text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Articles
                </a>
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
                    <h1 class="text-3xl font-bold text-text-primary mb-4">{{ $article->title }}</h1>

                    <div
                        class="flex items-center gap-4 text-sm text-text-secondary mb-6 pb-4 border-b border-background-secondary">
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
                </div>
            </article>

        </div>
    </div>
</x-app-layout>
