<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-text-primary mb-2">
                    @if (request('category'))
                        {{ $categoryName ?? __('pets.index.title_all') }}
                    @else
                        {{ __('pets.index.title_all') }}
                    @endif
                </h1>
                <p class="text-text-secondary">
                    {{ __('pets.index.subtitle') }}
                </p>
            </div>

            {{-- Filters & Search Section --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <form method="GET" action="{{ route('pets.index') }}" class="space-y-4">

                    {{-- Search Bar --}}
                    <div>
                        <label for="search" class="block text-sm font-medium text-text-primary mb-2">
                            {{ __('pets.index.search_label') }}
                        </label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="{{ __('pets.index.search_placeholder') }}"
                            class="w-full rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">
                    </div>

                    {{-- Filter Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        {{-- Category Filter --}}
                        <div>
                            <label for="category" class="block text-sm font-medium text-text-primary mb-2">
                                {{ __('pets.index.filter.category') }}
                            </label>
                            <select name="category" id="category"
                                class="w-full rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">
                                <option value="">{{ __('pets.index.filter.all_categories') }}</option>
                                @foreach (\App\Models\Category::whereNull('parent_id')->get() as $cat)
                                    <optgroup label="{{ $cat->name }}">
                                        <option value="{{ $cat->slug }}"
                                            {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                            {{ __('pets.index.filter.all_of', ['category' => $cat->name]) }}
                                        </option>
                                        @foreach ($cat->children as $subCat)
                                            <option value="{{ $subCat->slug }}"
                                                {{ request('category') == $subCat->slug ? 'selected' : '' }}>
                                                {{ $subCat->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        {{-- Size Filter --}}
                        <div>
                            <label for="size" class="block text-sm font-medium text-text-primary mb-2">
                                {{ __('pets.index.filter.size') }}
                            </label>
                            <select name="size" id="size"
                                class="w-full rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">
                                <option value="">All Sizes</option>
                                <option value="small" {{ request('size') == 'small' ? 'selected' : '' }}>Small
                                </option>
                                <option value="medium" {{ request('size') == 'medium' ? 'selected' : '' }}>Medium
                                </option>
                                <option value="large" {{ request('size') == 'large' ? 'selected' : '' }}>Large
                                </option>
                            </select>
                        </div>

                        {{-- Age Filter --}}
                        <div>
                            <label for="age" class="block text-sm font-medium text-text-primary mb-2">
                                {{ __('pets.index.filter.age') }}
                            </label>
                            <select name="age" id="age"
                                class="w-full rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">
                                <option value="">All Ages</option>
                                <option value="young" {{ request('age') == 'young' ? 'selected' : '' }}>Young (up to
                                    around 2 years)</option>
                                <option value="adult" {{ request('age') == 'adult' ? 'selected' : '' }}>Adult (about
                                    2-7 years)</option>
                                <option value="senior" {{ request('age') == 'senior' ? 'selected' : '' }}>Senior (about
                                    7+ years)</option>
                            </select>
                        </div>

                        {{-- Gender Filter --}}
                        <div>
                            <label for="gender" class="block text-sm font-medium text-text-primary mb-2">
                                {{ __('pets.index.filter.gender') }}
                            </label>
                            <select name="gender" id="gender"
                                class="w-full rounded-md border-background-secondary focus:border-accent-red focus:ring focus:ring-accent-red focus:ring-opacity-50">
                                <option value="">All Genders</option>
                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-3">
                        <button type="submit"
                            class="bg-accent-red hover:bg-opacity-90 text-white font-semibold py-2 px-6 rounded-md transition shadow-sm">
                            {{ __('pets.index.apply_filters') }}
                        </button>
                        <a href="{{ route('pets.index') }}"
                            class="bg-text-secondary hover:bg-opacity-90 text-white font-semibold py-2 px-6 rounded-md transition shadow-sm">
                            {{ __('pets.index.clear_all') }}
                        </a>
                    </div>
                </form>
            </div>

            {{-- Results Count --}}
            <div class="mb-6">
                <p class="text-text-secondary">
                    {{ __('pets.index.showing', ['count' => $pets->total()]) }}
                    @if (request()->hasAny(['category', 'search', 'size', 'age', 'gender']))
                        {{ __('pets.index.from_total', ['total' => \App\Models\Pet::where('is_available', true)->count()]) }}
                    @endif
                </p>
            </div>

            {{-- Pet Grid --}}
            @if ($pets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($pets as $pet)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">

                            {{-- Pet Image --}}
                            <a href="{{ route('pets.show', $pet) }}" class="block">
                                {{-- DEVELOPMENT: Priority pets.image (URL or filename); fallback to first pet_images.image_path --}}
                                @php
                                    $cardImage = null;
                                    if (!empty($pet->image)) {
                                        $cardImage = str_starts_with($pet->image, 'http')
                                            ? $pet->image
                                            : asset('storage/pets/' . $pet->image);
                                    } elseif ($pet->images->first()?->image_path) {
                                        $cardImage = asset('storage/' . $pet->images->first()->image_path);
                                    }
                                @endphp
                                @if ($cardImage)
                                    <div class="w-full aspect-square overflow-hidden bg-background-secondary">
                                        <img src="{{ $cardImage }}" alt="{{ $pet->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-full aspect-square bg-background-secondary flex items-center justify-center">
                                        <span class="text-text-muted">{{ __('pets.index.no_image') }}</span>
                                    </div>
                                @endif

                                {{-- PRODUCTION: Prioritize uploaded images (pet_images with is_primary) */}}
                                {{-- --
                                @php
                                    $primaryImage = $pet->images->where('is_primary', true)->first();
                                    $imageUrl = $primaryImage
                                        ? asset('storage/' . $primaryImage->image_path)
                                        : (!empty($pet->image) ? (str_starts_with($pet->image, 'http') ? $pet->image : asset('storage/pets/' . $pet->image)) : ($pet->images->first()? asset('storage/' . $pet->images->first()->image_path) : null));
                                @endphp
                                @if ($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-background-secondary flex items-center justify-center">
                                        <span class="text-text-muted">{{ __('pets.index.no_image') }}</span>
                                    </div>
                                @endif
                                -- --}}
                            </a>

                            {{-- Pet Info --}}
                            <div class="p-4">
                                <a href="{{ route('pets.show', $pet) }}" class="block mb-2">
                                    <h3 class="text-lg font-bold text-text-primary hover:text-accent-red transition">
                                        {{ $pet->name }}
                                    </h3>
                                </a>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-text-secondary">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $pet->shelter->name }}
                                    </div>

                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-text-secondary">
                                            {{ $pet->formatted_age }}
                                        </span>
                                        <span
                                            class="px-2 py-1 bg-background-primary text-text-primary text-xs font-medium rounded">
                                            {{ ucfirst($pet->size) }}
                                        </span>
                                    </div>

                                    @if ($pet->adoption_fee)
                                        <div class="text-accent-red font-bold">
                                            Rp {{ number_format($pet->adoption_fee, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>

                                        <a href="{{ route('pets.show', $pet) }}"
                                    class="block w-full text-center bg-accent-red hover:bg-opacity-90 text-white font-semibold py-2 rounded-md transition">
                                    {{ __('pets.index.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $pets->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-lg shadow-md p-16 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <svg class="mx-auto h-20 w-20 text-text-muted" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-text-primary mb-3">{{ __('pets.index.no_pets_found') }}</h3>
                        <p class="text-text-secondary mb-8 leading-relaxed">
                            {{ __('pets.index.no_pets_description') }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('pets.index') }}"
                                class="inline-block bg-accent-red hover:bg-opacity-90 text-white font-semibold py-3 px-8 rounded-md transition shadow-sm">
                                {{ __('pets.index.view_all') }}
                            </a>
                                <button onclick="window.history.back()"
                                class="inline-block bg-white hover:bg-background-primary text-text-primary font-semibold py-3 px-8 rounded-md transition border border-background-secondary">
                                {{ __('pets.index.go_back') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
