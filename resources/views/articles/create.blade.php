<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-text-primary">{{ __('articles.form.create') }}</h1>
                <a href="{{ route('articles.manage') }}" class="text-text-secondary hover:text-text-primary">{{ __('articles.index.manage') }}</a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-6">
                        <!-- Basic Info -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">{{ __('articles.form.sections.info') }}</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">{{ __('articles.form.fields.title') }}</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent"
                                        required>
                                    @error('title')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">{{ __('articles.form.fields.category') }}</label>
                                    <select name="category_id"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent">
                                        <option value="">{{ __('articles.form.fields.select_category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">{{ __('articles.form.fields.featured_image') }}</label>
                                    <input type="file" name="featured_image" accept="image/*"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent">
                                    <p class="text-xs text-text-muted mt-1">{{ __('articles.form.fields.featured_help') }}</p>
                                    @error('featured_image')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">{{ __('articles.form.fields.content') }}</label>
                                    <textarea name="content" rows="12"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent"
                                        required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-background-secondary">
                            <a href="{{ route('articles.manage') }}"
                                class="px-4 py-2 rounded-md border border-background-secondary bg-white hover:bg-gray-50">{{ __('messages.cancel') }}</a>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90">{{ __('articles.form.create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
