<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-text-primary">Edit Article</h1>
                <a href="{{ route('articles.manage') }}" class="text-text-secondary hover:text-text-primary">Back to
                    Manage</a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="p-6 space-y-6">
                        <!-- Basic Info -->
                        <div>
                            <h2 class="text-lg font-semibold text-text-primary mb-4">Article Information</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $article->title) }}"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent"
                                        required>
                                    @error('title')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">Category</label>
                                    <select name="category_id"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent">
                                        <option value="">Select category (optional)</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">Featured
                                        Image</label>
                                    @if ($article->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                alt="Current featured image" class="h-32 w-auto rounded-md">
                                            <p class="text-xs text-text-muted mt-1">Current image</p>
                                        </div>
                                    @endif
                                    <input type="file" name="featured_image" accept="image/*"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent">
                                    <p class="text-xs text-text-muted mt-1">Maximum file size: 2MB. Supported formats:
                                        JPEG, PNG, JPG, GIF. Leave empty to keep current image.</p>
                                    @error('featured_image')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-secondary mb-1">Content</label>
                                    <textarea name="content" rows="12"
                                        class="w-full rounded-md border border-background-secondary px-4 py-2 focus:ring-2 focus:ring-accent-red focus:border-transparent"
                                        required>{{ old('content', $article->content) }}</textarea>
                                    @error('content')
                                        <p class="text-accent-red text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-background-secondary">
                            <a href="{{ route('articles.manage') }}"
                                class="px-4 py-2 rounded-md border border-background-secondary bg-white hover:bg-gray-50">Cancel</a>
                            <button type="submit"
                                class="px-6 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90">Update
                                Article</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
