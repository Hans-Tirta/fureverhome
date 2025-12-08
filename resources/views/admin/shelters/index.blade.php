<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-text-primary">Shelter Verification</h1>
                <p class="text-text-secondary">Review and approve shelter registrations</p>
            </div>

            <!-- Status Filter Tabs -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.shelters', ['status' => 'all']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ $status === 'all' ? 'bg-accent-red text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        All Shelters
                    </a>
                    <a href="{{ route('admin.shelters', ['status' => 'pending']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ $status === 'pending' ? 'bg-accent-yellow text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        Pending
                        @if ($shelters->total() > 0 && $status === 'pending')
                            <span
                                class="ml-2 px-2 py-0.5 text-xs bg-white text-accent-yellow rounded-full">{{ $shelters->total() }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.shelters', ['status' => 'verified']) }}"
                        class="px-4 py-2 rounded-md font-medium {{ $status === 'verified' ? 'bg-accent-green text-white' : 'bg-white text-text-secondary border border-background-secondary hover:bg-background-primary' }}">
                        Verified
                    </a>
                </div>
            </div>

            <!-- Shelters Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-0">
                    @if ($shelters->count() > 0)
                        <table class="w-full table-auto divide-y divide-background-secondary">
                            <thead class="bg-background-secondary">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">
                                        Shelter</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">
                                        Contact</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">
                                        Registered</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">
                                        Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-background-secondary">
                                @foreach ($shelters as $shelter)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="text-text-primary font-semibold">{{ $shelter->name }}</div>
                                            <div class="text-sm text-text-secondary">
                                                {{ Str::limit($shelter->address, 50) }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-text-primary">{{ $shelter->user->name }}</div>
                                            <div class="text-sm text-text-secondary">{{ $shelter->email }}</div>
                                            <div class="text-sm text-text-secondary">{{ $shelter->phone }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-text-secondary">
                                            <div>{{ $shelter->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-text-muted">
                                                {{ $shelter->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($shelter->is_verified)
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">Verified</span>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded">Pending</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if (!$shelter->is_verified)
                                                <form action="{{ route('admin.shelters.approve', $shelter) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 text-sm font-semibold rounded-md text-white bg-accent-green hover:bg-opacity-90">
                                                        Approve
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-text-muted text-sm">Verified</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-3 border-t border-background-secondary">
                            {{ $shelters->appends(['status' => $status])->links() }}
                        </div>
                    @else
                        <div class="p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-text-muted" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <h3 class="mt-2 text-lg font-semibold text-text-primary">
                                @if ($status === 'pending')
                                    No Pending Shelters
                                @elseif($status === 'verified')
                                    No Verified Shelters
                                @else
                                    No Shelters Found
                                @endif
                            </h3>
                            <p class="mt-1 text-text-secondary">
                                @if ($status === 'pending')
                                    All shelter registrations have been processed.
                                @else
                                    Waiting for new shelter registrations.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
