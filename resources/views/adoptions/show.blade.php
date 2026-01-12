<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ auth()->user()->role === 'adopter' ? route('adoptions.my-requests') : route('adoptions.index') }}"
                    class="inline-flex items-center text-text-secondary hover:text-text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('adoptions.show.back_to_requests') }}
                </a>
            </div>

            {{-- Header with Status --}}
            <div class="mb-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-text-primary mb-2">{{ __('adoptions.show.title') }}</h1>
                        <p class="text-text-secondary">
                            {{ __('adoptions.show.submitted', ['date' => $adoption->created_at->format('F d, Y')]) }}
                        </p>
                    </div>
                    <div>
                        @if ($adoption->status === 'pending')
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-accent-blue text-white rounded-lg">{{ __('adoptions.show.status.pending') }}</span>
                        @elseif ($adoption->status === 'approved')
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-accent-green text-white rounded-lg">{{ __('adoptions.show.status.approved') }}</span>
                        @elseif ($adoption->status === 'rejected')
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-accent-red text-white rounded-lg">{{ __('adoptions.show.status.rejected') }}</span>
                        @else
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-text-secondary text-white rounded-lg">{{ __('adoptions.show.status.cancelled') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Main Content -->
                <div class="space-y-6">
                    <!-- Pet Image -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @php
                            $img = null;
                            if (!empty($adoption->pet->image)) {
                                $img = str_starts_with($adoption->pet->image, 'http')
                                    ? $adoption->pet->image
                                    : asset('storage/pets/' . $adoption->pet->image);
                            } elseif ($adoption->pet->images->first()?->image_path) {
                                $img = asset('storage/' . $adoption->pet->images->first()->image_path);
                            }
                        @endphp

                        @if ($img)
                            <div class="w-full aspect-square overflow-hidden bg-background-secondary">
                                <img src="{{ $img }}" alt="{{ $adoption->pet->name }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-full aspect-square bg-background-secondary flex items-center justify-center">
                                <span class="text-text-muted">{{ __('pets.index.no_image') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Request Details -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-text-primary mb-4">{{ __('adoptions.show.request_details') }}
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                    {{ __('adoptions.show.why_adopt') }}</h3>
                                <p class="text-text-primary">{{ $adoption->reason }}</p>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                    {{ __('adoptions.show.pet_experience') }}</h3>
                                <p class="text-text-primary">{{ $adoption->experience }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                        {{ __('adoptions.show.housing_type') }}</h3>
                                    <p class="text-text-primary">{{ ucfirst($adoption->housing_type) }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                        {{ __('adoptions.show.other_pets') }}</h3>
                                    <p class="text-text-primary">
                                        {{ $adoption->has_other_pets ? __('messages.yes') ?? 'Yes' : __('messages.no') ?? 'No' }}
                                    </p>
                                </div>
                            </div>

                            @if ($adoption->has_other_pets && $adoption->other_pets_details)
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                        {{ __('adoptions.show.other_pets_details') }}</h3>
                                    <p class="text-text-primary">{{ $adoption->other_pets_details }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                        {{ __('adoptions.show.children_in_household') }}
                                    </h3>
                                    <p class="text-text-primary">
                                        {{ $adoption->has_children ? __('messages.yes') ?? 'Yes' : __('messages.no') ?? 'No' }}
                                    </p>
                                </div>
                                @if ($adoption->has_children && $adoption->children_ages)
                                    <div>
                                        <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                            {{ __('adoptions.show.children_ages') }}</h3>
                                        <p class="text-text-primary">{{ $adoption->children_ages }}</p>
                                    </div>
                                @endif
                            </div>

                            @if ($adoption->references)
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">
                                        {{ __('adoptions.show.references') }}</h3>
                                    <p class="text-text-primary">{{ $adoption->references }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Pet Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-text-primary mb-4">{{ __('adoptions.show.pet_information') }}
                        </h2>
                        <div class="space-y-3">
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary mb-1">{{ __('messages.name') }}
                                </h3>
                                <p class="text-lg font-bold text-text-primary">{{ $adoption->pet->name }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">
                                        {{ __('messages.category') }}</h3>
                                    <p class="text-text-primary">{{ $adoption->pet->category->name }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">
                                        {{ __('messages.size') }}</h3>
                                    <p class="text-text-primary">{{ ucfirst($adoption->pet->size) }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">
                                        {{ __('pets.show.gender') }}</h3>
                                    <p class="text-text-primary">{{ ucfirst($adoption->pet->gender) }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">{{ __('messages.age') }}
                                    </h3>
                                    <p class="text-text-primary">{{ $adoption->pet->formatted_age }}</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary mb-1">{{ __('messages.shelter') }}
                                </h3>
                                <p class="font-semibold text-text-primary">{{ $adoption->pet->shelter->name }}</p>
                            </div>
                            <div class="pt-2">
                                <a href="{{ route('pets.show', $adoption->pet) }}"
                                    class="inline-flex items-center text-accent-red text-sm font-semibold hover:underline">
                                    {{ __('adoptions.show.view_full_pet') }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Adopter Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-bold text-text-primary mb-4">
                            {{ __('adoptions.show.adopter_information') }}</h2>
                        <div class="space-y-3">
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">{{ __('messages.name') }}</h3>
                                <p class="text-text-primary">{{ $adoption->user->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">{{ __('messages.email') }}</h3>
                                <p class="text-text-primary">{{ $adoption->user->email }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">{{ __('messages.phone') }}</h3>
                                <p class="text-text-primary">{{ $adoption->phone }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">{{ __('messages.address') }}</h3>
                                <p class="text-text-primary">{{ $adoption->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions for Shelter/Admin -->
                    @if (auth()->user()->role === 'admin' ||
                            (auth()->user()->role === 'shelter' && auth()->user()->shelter?->id === $adoption->pet->shelter_id))
                        @if ($adoption->status === 'pending')
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-lg font-bold text-text-primary mb-4">
                                    {{ __('adoptions.show.review_request') }}</h2>

                                <!-- Approve Form -->
                                <form method="POST" action="{{ route('adoptions.update', $adoption) }}"
                                    class="mb-3">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit"
                                        onclick="return confirm('{{ __('adoptions.show.approve_confirm') }}')"
                                        class="w-full px-4 py-3 rounded-md bg-accent-green text-white font-semibold hover:bg-opacity-90 shadow-sm">
                                        {{ __('adoptions.show.approve') }}
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <button onclick="openRejectModal()"
                                    class="w-full px-4 py-3 rounded-md bg-white border-2 border-accent-red text-accent-red font-semibold hover:bg-red-50">
                                    {{ __('adoptions.show.reject') }}
                                </button>
                            </div>
                        @elseif ($adoption->status === 'approved')
                            <div class="bg-white border-2 border-accent-green rounded-lg p-6 text-center">
                                <svg class="w-16 h-16 text-accent-green mx-auto mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-lg font-bold text-accent-green mb-1">
                                    {{ __('adoptions.show.request_approved') }}</h3>
                                @if ($adoption->reviewed_at)
                                    <p class="text-sm text-text-secondary">
                                        {{ $adoption->reviewed_at->format('F d, Y') }}</p>
                                @endif
                            </div>
                        @endif
                    @endif

                    <!-- Cancel Button for Adopter -->
                    @if (auth()->user()->id === $adoption->user_id && $adoption->status === 'pending')
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-lg font-bold text-text-primary mb-4">{{ __('adoptions.show.cancel') }}
                            </h2>
                            <form method="POST" action="{{ route('adoptions.destroy', $adoption) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('{{ __('adoptions.show.cancel_confirm') }}')"
                                    class="w-full px-4 py-3 rounded-md bg-white border-2 border-text-secondary text-text-secondary font-semibold hover:bg-background-primary">
                                    {{ __('adoptions.show.cancel_request') }}
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Rejection Reason (if rejected) -->
                    @if ($adoption->status === 'rejected' && $adoption->rejection_reason)
                        <div class="bg-red-50 border-2 border-accent-red rounded-lg p-6">
                            <h2 class="text-lg font-bold text-accent-red mb-2">
                                {{ __('adoptions.show.rejection_reason') }}</h2>
                            <p class="text-text-primary">{{ $adoption->rejection_reason }}</p>
                            @if ($adoption->reviewed_at)
                                <p class="text-sm text-text-secondary mt-2">{{ __('adoptions.show.reviewed_on') }}
                                    {{ $adoption->reviewed_at->format('F d, Y') }}</p>
                            @endif
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4"
        style="z-index: 9999;">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <h2 class="text-xl font-bold text-text-primary mb-4">{{ __('adoptions.show.reject') }}</h2>
            <form method="POST" action="{{ route('adoptions.update', $adoption) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">

                <div class="pt-2">
                    <a href="{{ route('pets.show', $adoption->pet) }}"
                        class="inline-flex items-center text-accent-red text-sm font-semibold hover:underline">
                        {{ __('adoptions.show.view_full_pet') }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90">
                    {{ __('adoptions.show.reject') }}
                </button>
        </div>
        </form>
    </div>
    </div>

    <script>
        function openRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
