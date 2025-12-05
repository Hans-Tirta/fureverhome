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
                    Back to Requests
                </a>
            </div>

            {{-- Header with Status --}}
            <div class="mb-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-text-primary mb-2">Adoption Request Details</h1>
                        <p class="text-text-secondary">Submitted {{ $adoption->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        @if ($adoption->status === 'pending')
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-accent-blue text-white rounded-lg">Pending
                                Review</span>
                        @elseif ($adoption->status === 'approved')
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-accent-green text-white rounded-lg">
                                Approved</span>
                        @elseif ($adoption->status === 'rejected')
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-accent-red text-white rounded-lg">
                                Rejected</span>
                        @else
                            <span
                                class="inline-block px-4 py-2 text-sm font-semibold bg-text-secondary text-white rounded-lg">Cancelled</span>
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
                                <span class="text-text-muted">No image</span>
                            </div>
                        @endif
                    </div>

                    <!-- Request Details -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-text-primary mb-4">Request Details</h2>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-semibold text-text-secondary mb-1">Why adopt this pet?</h3>
                                <p class="text-text-primary">{{ $adoption->reason }}</p>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-text-secondary mb-1">Pet Ownership Experience</h3>
                                <p class="text-text-primary">{{ $adoption->experience }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">Housing Type</h3>
                                    <p class="text-text-primary">{{ ucfirst($adoption->housing_type) }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">Other Pets</h3>
                                    <p class="text-text-primary">{{ $adoption->has_other_pets ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>

                            @if ($adoption->has_other_pets && $adoption->other_pets_details)
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">Other Pets Details</h3>
                                    <p class="text-text-primary">{{ $adoption->other_pets_details }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">Children in Household
                                    </h3>
                                    <p class="text-text-primary">{{ $adoption->has_children ? 'Yes' : 'No' }}</p>
                                </div>
                                @if ($adoption->has_children && $adoption->children_ages)
                                    <div>
                                        <h3 class="text-sm font-semibold text-text-secondary mb-1">Children Ages</h3>
                                        <p class="text-text-primary">{{ $adoption->children_ages }}</p>
                                    </div>
                                @endif
                            </div>

                            @if ($adoption->references)
                                <div>
                                    <h3 class="text-sm font-semibold text-text-secondary mb-1">References</h3>
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
                        <h2 class="text-xl font-bold text-text-primary mb-4">Pet Information</h2>
                        <div class="space-y-3">
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary mb-1">Name</h3>
                                <p class="text-lg font-bold text-text-primary">{{ $adoption->pet->name }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">Category</h3>
                                    <p class="text-text-primary">{{ $adoption->pet->category->name }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">Size</h3>
                                    <p class="text-text-primary">{{ ucfirst($adoption->pet->size) }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">Gender</h3>
                                    <p class="text-text-primary">{{ ucfirst($adoption->pet->gender) }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-text-secondary mb-1">Age</h3>
                                    <p class="text-text-primary">{{ $adoption->pet->formatted_age }}</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary mb-1">Shelter</h3>
                                <p class="font-semibold text-text-primary">{{ $adoption->pet->shelter->name }}</p>
                            </div>
                            <div class="pt-2">
                                <a href="{{ route('pets.show', $adoption->pet) }}"
                                    class="inline-flex items-center text-accent-red text-sm font-semibold hover:underline">
                                    View Full Pet Profile
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
                        <h2 class="text-lg font-bold text-text-primary mb-4">Adopter Information</h2>
                        <div class="space-y-3">
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">Name</h3>
                                <p class="text-text-primary">{{ $adoption->user->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">Email</h3>
                                <p class="text-text-primary">{{ $adoption->user->email }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">Phone</h3>
                                <p class="text-text-primary">{{ $adoption->phone }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-text-secondary">Address</h3>
                                <p class="text-text-primary">{{ $adoption->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions for Shelter/Admin -->
                    @if (auth()->user()->role === 'admin' ||
                            (auth()->user()->role === 'shelter' && auth()->user()->shelter?->id === $adoption->pet->shelter_id))
                        @if ($adoption->status === 'pending')
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-lg font-bold text-text-primary mb-4">Review Request</h2>

                                <!-- Approve Form -->
                                <form method="POST" action="{{ route('adoptions.update', $adoption) }}"
                                    class="mb-3">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to approve this adoption request? The pet will be marked as unavailable.')"
                                        class="w-full px-4 py-3 rounded-md bg-accent-green text-white font-semibold hover:bg-opacity-90 shadow-sm">
                                        Approve Request
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <button onclick="openRejectModal()"
                                    class="w-full px-4 py-3 rounded-md bg-white border-2 border-accent-red text-accent-red font-semibold hover:bg-red-50">
                                    Reject Request
                                </button>
                            </div>
                        @elseif ($adoption->status === 'approved')
                            <div class="bg-white border-2 border-accent-green rounded-lg p-6 text-center">
                                <svg class="w-16 h-16 text-accent-green mx-auto mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-lg font-bold text-accent-green mb-1">Request Approved</h3>
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
                            <h2 class="text-lg font-bold text-text-primary mb-4">Cancel Request</h2>
                            <form method="POST" action="{{ route('adoptions.destroy', $adoption) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to cancel this adoption request?')"
                                    class="w-full px-4 py-3 rounded-md bg-white border-2 border-text-secondary text-text-secondary font-semibold hover:bg-background-primary">
                                    Cancel My Request
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Rejection Reason (if rejected) -->
                    @if ($adoption->status === 'rejected' && $adoption->rejection_reason)
                        <div class="bg-red-50 border-2 border-accent-red rounded-lg p-6">
                            <h2 class="text-lg font-bold text-accent-red mb-2">Rejection Reason</h2>
                            <p class="text-text-primary">{{ $adoption->rejection_reason }}</p>
                            @if ($adoption->reviewed_at)
                                <p class="text-sm text-text-secondary mt-2">Reviewed on
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
            <h2 class="text-xl font-bold text-text-primary mb-4">Reject Adoption Request</h2>
            <form method="POST" action="{{ route('adoptions.update', $adoption) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-text-secondary mb-2">Reason for Rejection *</label>
                    <textarea name="rejection_reason" rows="4" class="w-full rounded-md border border-background-secondary"
                        placeholder="Please provide a reason for rejection..." required></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="flex-1 px-4 py-2 rounded-md border border-background-secondary bg-white text-text-secondary hover:bg-background-primary">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 rounded-md bg-accent-red text-white font-semibold hover:bg-opacity-90">
                        Reject Request
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
