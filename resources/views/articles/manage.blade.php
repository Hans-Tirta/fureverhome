<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-text-primary">{{ __('articles.index.manage_page.title') }}</h1>
                    <p class="text-text-secondary">{{ __('articles.index.manage_page.subtitle') }}</p>
                </div>
                <a href="{{ route('articles.create') }}"
                    class="px-4 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                    {{ __('articles.index.manage_page.create') }}
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if ($articles->count() > 0)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                        <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('articles.index.manage_page.table.title') }}
                                    </th>
                                        <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('articles.index.manage_page.table.category') }}
                                    </th>
                                        <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('articles.index.manage_page.table.author') }}
                                    </th>
                                        <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('articles.index.manage_page.table.views') }}
                                    </th>
                                        <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('articles.index.manage_page.table.created') }}
                                    </th>
                                        <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('articles.index.manage_page.table.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($articles as $article)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if ($article->featured_image)
                                                    <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                        alt="{{ $article->title }}"
                                                        class="h-12 w-16 rounded object-cover mr-3 flex-shrink-0">
                                                @else
                                                    <div
                                                        class="h-12 w-16 rounded bg-accent-red mr-3 flex-shrink-0 flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-white opacity-70" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="min-w-0 flex-1">
                                                    <div class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $article->title }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        {{ Str::limit(strip_tags($article->content), 60) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($article->category)
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $article->category->name }}
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                                    {{ __('articles.index.manage_page.uncategorized') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-accent-yellow flex items-center justify-center text-white text-xs font-bold mr-2">
                                                    {{ strtoupper(substr($article->author->name, 0, 1)) }}
                                                </div>
                                                <div class="text-sm text-gray-900">{{ $article->author->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                {{ number_format($article->views) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div>{{ $article->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-400">
                                                {{ $article->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('articles.show', $article) }}"
                                                    class="text-blue-600 hover:text-blue-900 font-medium">{{ __('messages.view') }}</a>
                                                <a href="{{ route('articles.edit', $article) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-medium">{{ __('messages.edit') }}</a>
                                                <form method="POST" action="{{ route('articles.destroy', $article) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('{{ __('articles.show.delete_confirm') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 font-medium">{{ __('articles.show.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-20 h-20 text-text-muted mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-text-primary mb-2">{{ __('articles.index.manage_page.empty_title') }}</h3>
                    <p class="text-text-secondary mb-6">{{ __('articles.index.manage_page.empty_description') }}</p>
                    <a href="{{ route('articles.create') }}"
                        class="inline-block px-6 py-3 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                        {{ __('articles.index.manage_page.empty_cta') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
