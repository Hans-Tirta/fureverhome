<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-text-primary">{{ __('adoptions.index.title') }}</h1>
                    <p class="text-text-secondary">{{ __('adoptions.index.subtitle') }}</p>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('adoptions.index') }}"
                        class="px-4 py-2 rounded-md font-medium {{ !request('status') ? 'bg-accent-red text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        {{ __('adoptions.index.tabs.all') }}
                    </a>
                    <a href="{{ route('adoptions.index', ['status' => 'pending']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ request('status') === 'pending' ? 'bg-accent-yellow text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        {{ __('adoptions.index.tabs.pending') }}
                    </a>
                    <a href="{{ route('adoptions.index', ['status' => 'approved']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ request('status') === 'approved' ? 'bg-accent-green text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        {{ __('adoptions.index.tabs.approved') }}
                    </a>
                    <a href="{{ route('adoptions.index', ['status' => 'rejected']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ request('status') === 'rejected' ? 'bg-accent-red text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        {{ __('adoptions.index.tabs.rejected') }}
                    </a>
                    <a href="{{ route('adoptions.index', ['status' => 'cancelled']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ request('status') === 'cancelled' ? 'bg-text-secondary text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        {{ __('adoptions.index.tabs.cancelled') }}
                    </a>
                </div>
            </div>

            <!-- Requests Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($adoptions->count() > 0)
                    <table class="w-full table-auto divide-y divide-background-secondary">
                        <thead class="bg-background-secondary">
                            <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('adoptions.index.table.pet') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('adoptions.index.table.adopter') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('adoptions.index.table.submitted') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('adoptions.index.table.status') }}</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('adoptions.index.table.actions') }}</th>
                                </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-background-secondary">
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
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if ($img)
                                                <img src="{{ $img }}" alt="{{ $adoption->pet->name }}"
                                                    class="w-16 h-16 object-cover rounded">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-background-secondary rounded flex items-center justify-center">
                                                    <span class="text-xs text-text-muted">{{ __('pets.index.no_image') }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-semibold text-text-primary">{{ $adoption->pet->name }}
                                                </p>
                                                <p class="text-xs text-text-secondary">
                                                    {{ $adoption->pet->category->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-text-primary">{{ $adoption->user->name }}</p>
                                        <p class="text-xs text-text-secondary">{{ $adoption->user->email }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-text-secondary">
                                        {{ $adoption->created_at->format('M d, Y') }}
                                        <span class="text-xs block">{{ $adoption->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($adoption->status === 'pending')
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold bg-accent-yellow text-white rounded">{{ __('adoptions.show.status.pending') }}</span>
                                        @elseif ($adoption->status === 'approved')
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold bg-accent-green text-white rounded">{{ __('adoptions.show.status.approved') }}</span>
                                        @elseif ($adoption->status === 'rejected')
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold bg-accent-red text-white rounded">{{ __('adoptions.show.status.rejected') }}</span>
                                        @else
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold bg-text-secondary text-white rounded">{{ __('adoptions.show.status.cancelled') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('adoptions.show', $adoption) }}"
                                            class="px-3 py-1.5 text-sm font-semibold rounded-md bg-white border border-background-secondary hover:bg-background-primary">
                                            {{ __('adoptions.index.view_details') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-4 py-3 border-t border-background-secondary">
                        {{ $adoptions->links() }}
                    </div>
                @else
                        <div class="p-8 text-center">
                        <svg class="w-16 h-16 text-text-muted mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-bold text-text-primary mb-2">{{ __('adoptions.index.empty_title') }}</h3>
                        <p class="text-text-secondary">
                            @if (request('status'))
                                {{ __('adoptions.index.empty') }}
                            @else
                                {{ __('adoptions.index.empty_description') }}
                            @endif
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
