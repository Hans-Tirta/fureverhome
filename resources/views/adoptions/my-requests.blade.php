<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-text-primary mb-2">My Adoption Requests</h1>
                <p class="text-text-secondary">Track the status of your adoption applications</p>
            </div>

            {{-- Requests Grid --}}
            @if ($adoptions->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($adoptions as $adoption)
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

                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            {{-- Pet Image --}}
                            <a href="{{ route('adoptions.show', $adoption) }}" class="block">
                                @if ($img)
                                    <div class="w-full aspect-square overflow-hidden bg-background-secondary">
                                        <img src="{{ $img }}" alt="{{ $adoption->pet->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-full aspect-square bg-background-secondary flex items-center justify-center">
                                        <span class="text-text-muted">No image</span>
                                    </div>
                                @endif
                            </a>

                            {{-- Request Info --}}
                            <div class="p-4">
                                <a href="{{ route('adoptions.show', $adoption) }}" class="block mb-2">
                                    <h3 class="text-lg font-bold text-text-primary hover:text-accent-red transition">
                                        {{ $adoption->pet->name }}
                                    </h3>
                                </a>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-text-secondary">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $adoption->pet->shelter->name }}
                                    </div>

                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-text-secondary">
                                            {{ $adoption->pet->formatted_age }}
                                        </span>
                                        <span
                                            class="px-2 py-1 bg-background-primary text-text-primary text-xs font-medium rounded">
                                            {{ ucfirst($adoption->pet->size) }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-text-muted text-xs">
                                            {{ $adoption->created_at->diffForHumans() }}
                                        </span>
                                        @if ($adoption->status === 'pending')
                                            <span
                                                class="px-2 py-1 bg-accent-blue text-white text-xs font-semibold rounded">Pending</span>
                                        @elseif ($adoption->status === 'approved')
                                            <span
                                                class="px-2 py-1 bg-accent-green text-white text-xs font-semibold rounded">Approved</span>
                                        @elseif ($adoption->status === 'rejected')
                                            <span
                                                class="px-2 py-1 bg-accent-red text-white text-xs font-semibold rounded">Rejected</span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-text-secondary text-white text-xs font-semibold rounded">Cancelled</span>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('adoptions.show', $adoption) }}"
                                    class="block w-full text-center bg-accent-red hover:bg-opacity-90 text-white font-semibold py-2 rounded-md transition">
                                    View Details
                                </a>

                                @if ($adoption->status === 'pending')
                                    <form method="POST" action="{{ route('adoptions.destroy', $adoption) }}"
                                        class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Cancel this adoption request?')"
                                            class="w-full text-center bg-white border border-background-secondary text-text-secondary hover:bg-background-primary font-medium py-2 rounded-md transition text-sm">
                                            Cancel Request
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $adoptions->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-20 h-20 text-text-muted mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-text-primary mb-2">No Adoption Requests Yet</h3>
                    <p class="text-text-secondary mb-6">You haven't submitted any adoption requests. Browse available
                        pets to get started!</p>
                    <a href="{{ route('pets.index') }}"
                        class="inline-block px-6 py-3 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90 shadow-sm">
                        Browse Pets
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
