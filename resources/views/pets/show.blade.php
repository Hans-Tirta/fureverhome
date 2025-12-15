<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-6">
                    <a href="{{ route('pets.index', ['category' => $pet->category->slug]) }}"
                    class="inline-flex items-center text-text-secondary hover:text-text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('pets.show.back_to_category', ['category' => $pet->category->name]) }}
                </a>
            </div>

            {{-- Row 1: Image & Name Card + Quick Info Card --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                {{-- Left Card: Image & Name --}}
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    {{-- Image Gallery Section --}}
                    <div class="p-6">
                        {{-- Pet Name & Status --}}
                        <div class="mb-4">
                            <div class="flex items-start justify-between mb-2">
                                <h1 class="text-3xl font-bold text-text-primary">{{ $pet->name }}</h1>
                                @if ($pet->is_available)
                                    <span class="px-3 py-1 bg-accent-green text-white text-sm font-medium rounded-full">
                                        {{ __('pets.show.status.available') }}
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-text-secondary text-white text-sm font-medium rounded-full">
                                        {{ __('pets.show.status.adopted') }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-text-secondary">{{ $pet->breed ?? $pet->category->name }}</p>
                        </div>
                        @if ($pet->image || $pet->images->count() > 0)
                            {{-- Main Image --}}
                            <div class="mb-4">
                                {{-- DEVELOPMENT: Priority pets.image (URL or filename); fallback to first pet_images.image_path --}}
                                @php
                                    $mainImageUrl = null;
                                    if (!empty($pet->image)) {
                                        $mainImageUrl = str_starts_with($pet->image, 'http')
                                            ? $pet->image
                                            : asset('storage/pets/' . $pet->image);
                                    } elseif ($pet->images->first()?->image_path) {
                                        $mainImageUrl = asset('storage/' . $pet->images->first()->image_path);
                                    }
                                @endphp

                                {{-- PRODUCTION: Prioritize uploaded images (pet_images with is_primary)
                                @php
                                    $primaryImage = $pet->images->where('is_primary', true)->first();
                                    $mainImageUrl = $primaryImage
                                        ? asset('storage/' . $primaryImage->image_path)
                                        : (!empty($pet->image) ? (str_starts_with($pet->image, 'http') ? $pet->image : asset('storage/pets/' . $pet->image)) : ($pet->images->first()? asset('storage/' . $pet->images->first()->image_path) : null));
                                @endphp
                                --}}

                                @if ($mainImageUrl)
                                    <div
                                        class="w-full aspect-square overflow-hidden rounded-lg bg-background-secondary">
                                        <img id="mainImage" src="{{ $mainImageUrl }}" alt="{{ $pet->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>

                            {{-- Thumbnail Gallery --}}
                            @if ($pet->images->count() > 1)
                                <div class="grid grid-cols-4 gap-2">
                                    @foreach ($pet->images as $image)
                                        <div class="w-full aspect-square overflow-hidden rounded">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                alt="{{ $pet->name }}"
                                                class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition {{ $image->is_primary ? 'ring-2 ring-accent-red' : '' }}"
                                                onclick="document.getElementById('mainImage').src = this.src">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            {{-- Placeholder if no images --}}
                            <div class="w-full h-96 bg-background-primary rounded-lg flex items-center justify-center">
                                <span class="text-text-muted text-lg">{{ __('pets.show.no_image') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right Card: Quick Info & CTA --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    {{-- Quick Info Grid --}}
                    <h3 class="text-xl font-semibold text-text-primary mb-4">{{ __('pets.show.details_title') }}</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.age') }}</p>
                            <p class="text-text-primary font-medium">{{ $pet->formatted_age }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.gender') }}</p>
                            <p class="text-text-primary font-medium">{{ ucfirst($pet->gender) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.size') }}</p>
                            <p class="text-text-primary font-medium">{{ ucfirst($pet->size) }}</p>
                        </div>
                        @if ($pet->color)
                            <div>
                                <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.color') }}</p>
                                <p class="text-text-primary font-medium">{{ $pet->color }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Adoption Fee --}}
                    @if ($pet->adoption_fee)
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-text-primary mb-3">{{ __('pets.show.adoption_fee') }}</h3>
                            <p class="text-2xl font-bold text-accent-red">
                                Rp {{ number_format($pet->adoption_fee, 0, ',', '.') }}
                            </p>
                        </div>
                    @endif

                    {{-- Shelter Information --}}
                    <div class="mb-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-xl font-semibold text-text-primary">{{ $pet->shelter->name }}</h3>
                            @if ($pet->shelter->is_verified)
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('shelters.show.verified') }}
                                </span>
                            @endif
                        </div>
                        <div class="space-y-3">
                            <div class="space-y-1 text-sm text-text-secondary">
                                @if ($pet->shelter->address)
                                    <p>{{ $pet->shelter->address }}</p>
                                @endif
                                @if ($pet->shelter->phone)
                                    <p>{{ $pet->shelter->phone }}</p>
                                @endif
                                @if ($pet->shelter->email)
                                    <p>{{ $pet->shelter->email }}</p>
                                @endif
                            </div>
                            <a href="{{ route('shelters.show', $pet->shelter) }}"
                                class="inline-flex items-center text-accent-blue hover:text-opacity-80 text-sm font-medium">
                                {{ __('pets.show.view_shelter_profile') }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    @if ($pet->is_available)
                        <div class="flex flex-col gap-3">
                            @auth
                                @if (auth()->user()->role === 'adopter')
                                    <a href="{{ route('adoptions.create', $pet) }}"
                                        class="w-full bg-accent-red hover:bg-opacity-90 text-white font-semibold py-3 px-6 rounded-lg transition shadow-sm text-center">
                                        {{ __('pets.show.request_adoption') }}
                                    </a>
                                    @if ($pet->shelter->is_verified)
                                        <a href="{{ route('sponsorships.create', $pet->shelter) }}"
                                            class="w-full border-2 border-accent-green text-accent-green hover:bg-accent-green hover:text-white font-semibold py-3 px-6 rounded-lg transition text-center">
                                            {{ __('pets.show.sponsor_shelter') }}
                                        </a>
                                    @endif
                                @else
                                    <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-sm text-blue-800">{{ __('pets.show.adopter_only') }}</p>
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full bg-accent-red hover:bg-opacity-90 text-white font-semibold py-3 px-6 rounded-lg transition shadow-sm text-center">
                                    {{ __('pets.show.login_to_adopt') }}
                                </a>
                            @endauth
                        </div>
                    @else
                        <div class="text-center p-4 bg-gray-100 rounded-lg">
                            <p class="text-gray-700 font-semibold">{{ __('pets.show.not_available') }}</p>
                        </div>
                    @endif
                </div>

            </div>

            {{-- Row 2: Full Details Card --}}
            <div class="bg-white rounded-lg shadow-md p-8">

                {{-- Behavioral Traits --}}
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-text-primary mb-4">{{ __('pets.show.personality') }}</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-2">
                            @if ($pet->is_neutered)
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-green"></span>
                            @else
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-red"></span>
                            @endif
                            <span class="text-text-secondary">{{ __('pets.show.neutered') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if ($pet->is_house_trained)
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-green"></span>
                            @else
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-red"></span>
                            @endif
                            <span class="text-text-secondary">{{ __('pets.show.house_trained') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if ($pet->good_with_kids)
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-green"></span>
                            @else
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-red"></span>
                            @endif
                            <span class="text-text-secondary">{{ __('pets.show.good_with_kids') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if ($pet->good_with_pets)
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-green"></span>
                            @else
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-accent-red"></span>
                            @endif
                            <span class="text-text-secondary">{{ __('pets.show.good_with_pets') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-text-primary mb-4">{{ __('pets.show.about', ['name' => $pet->name]) }}</h3>
                    <p class="text-text-secondary leading-relaxed">{{ $pet->description }}</p>
                </div>

                {{-- Health Information --}}
                @if ($pet->health_status || $pet->vaccination_status || $pet->medical_history)
                    <div>
                        <h3 class="text-xl font-semibold text-text-primary mb-4">{{ __('pets.show.health_information') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if ($pet->health_status)
                                <div>
                                    <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.health_status') }}</p>
                                    <p class="text-text-primary">{{ $pet->health_status }}</p>
                                </div>
                            @endif
                            @if ($pet->vaccination_status)
                                <div>
                                    <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.vaccination_status') }}</p>
                                    <p class="text-text-primary">{{ $pet->vaccination_status }}</p>
                                </div>
                            @endif
                            @if ($pet->medical_history)
                                <div class="md:col-span-2">
                                    <p class="text-sm text-text-secondary mb-1">{{ __('pets.show.medical_history') }}</p>
                                    <p class="text-text-primary">{{ $pet->medical_history }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
