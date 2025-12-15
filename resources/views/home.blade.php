<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-text-primary to-background-secondary min-h-[700px] flex items-center">
        <!-- Background Image Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
            style="background-image: url('{{ asset('images/hero.webp') }}');">
        </div>

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-text-primary/60 to-text-primary/40"></div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center w-full">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white drop-shadow-lg">
                {{ __('home.hero.title') }}
            </h1>
            <p class="text-xl md:text-2xl mb-10 text-white/95 max-w-3xl mx-auto drop-shadow">
                {{ __('home.hero.subtitle') }}
            </p>

            <!-- Category Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-8">
                @foreach (\App\Models\Category::whereNull('parent_id')->get() as $category)
                    <a href="{{ route('pets.index', ['category' => $category->slug]) }}"
                        class="bg-white/90 backdrop-blur-sm p-6 rounded-lg shadow-lg hover:shadow-xl hover:bg-white transition text-center transform hover:scale-105">
                        <div class="text-4xl mb-3">{{ $category->icon }}</div>
                        <div class="font-semibold text-text-primary text-lg">{{ $category->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="bg-white py-16 border-b border-background-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-text-primary mb-6">
                        {{ __('home.about.title') }}
                    </h2>
                    <p class="text-lg text-text-secondary mb-8 leading-relaxed">
                        {{ __('home.about.description') }}
                    </p>

                    <!-- Statistics -->
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center p-4 bg-background-primary rounded-lg">
                            <div class="text-3xl font-bold text-accent-green mb-2">
                                {{ \App\Models\Adoption::where('status', 'completed')->count() }}
                            </div>
                            <div class="text-text-secondary">{{ __('home.about.stats.successful_adoptions') }}</div>
                        </div>
                        <div class="text-center p-4 bg-background-primary rounded-lg">
                            <div class="text-3xl font-bold text-accent-blue mb-2">
                                {{ \App\Models\Shelter::where('is_verified', true)->count() }}
                            </div>
                            <div class="text-text-secondary">{{ __('home.about.stats.trusted_shelters') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="aspect-[4/3] rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset('images/about2.webp') }}" alt="{{ __('home.about.images.happy_alt') }}"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-background-secondary text-text-primary py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">{{ __('home.how_it_works.title') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <img src="{{ asset('images/browse.webp') }}" alt="{{ __('home.how_it_works.steps.browse.alt') }}"
                        class="w-40 h-40 bg-white rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-semibold text-lg mb-2">{{ __('home.how_it_works.steps.browse.title') }}</h3>
                    <p>{{ __('home.how_it_works.steps.browse.description') }}</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/contact.webp') }}"
                        alt="{{ __('home.how_it_works.steps.contact.alt') }}"
                        class="w-40 h-40 bg-white rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-semibold text-lg mb-2">{{ __('home.how_it_works.steps.contact.title') }}</h3>
                    <p>{{ __('home.how_it_works.steps.contact.description') }}</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/adopt.webp') }}" alt="{{ __('home.how_it_works.steps.adopt.alt') }}"
                        class="w-40 h-40 bg-white rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-semibold text-lg mb-2">{{ __('home.how_it_works.steps.adopt.title') }}</h3>
                    <p>{{ __('home.how_it_works.steps.adopt.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
