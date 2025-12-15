<x-app-layout>
    <div class="min-h-screen bg-background-primary py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-text-primary">{{ __('pets.manage.title') }}</h1>
                    <p class="text-text-secondary">{{ __('pets.manage.subtitle') }}</p>
                </div>
                <a href="{{ route('pets.create') }}"
                    class="bg-accent-red hover:bg-opacity-90 text-white font-semibold py-2 px-6 rounded-md transition shadow-sm">{{ __('pets.manage.add_new') }}</a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-0">
                    @if ($pets->count() > 0)
                        <table class="w-full table-auto divide-y divide-background-secondary">
                            <thead class="bg-background-secondary">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('pets.manage.table.image') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('pets.manage.table.name') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('pets.manage.table.category') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('pets.manage.table.age') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">
                                            {{ __('pets.manage.table.availability') }}</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary">{{ __('pets.manage.table.actions') }}
                                        </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-background-secondary">
                                @foreach ($pets as $pet)
                                    @php
                                        // Align with index/show logic: dev uses pets.image as URL or filename; prod fallback to pet_images
                                        $img = null;
                                        if (!empty($pet->image)) {
                                            $img = str_starts_with($pet->image, 'http')
                                                ? $pet->image
                                                : asset('storage/pets/' . $pet->image);
                                        } elseif ($pet->images->first()?->image_path) {
                                            $img = asset('storage/' . $pet->images->first()->image_path);
                                        }
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3">
                                            @if ($img)
                                                <img src="{{ $img }}" alt="{{ $pet->name }}"
                                                    class="w-16 h-16 object-cover rounded">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-background-secondary rounded flex items-center justify-center">
                                                    <span class="text-xs text-text-muted">{{ __('pets.manage.no_image') }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-text-primary font-semibold">{{ $pet->name }}</td>
                                        <td class="px-4 py-3 text-text-secondary">{{ $pet->category->name }}</td>
                                        <td class="px-4 py-3 text-text-secondary">{{ $pet->formatted_age }}</td>
                                        <td class="px-4 py-3">
                                            @if ($pet->is_available)
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">{{ __('pets.manage.available') }}</span>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded">{{ __('pets.manage.hidden') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('pets.edit', $pet) }}"
                                                    class="px-3 py-1.5 text-sm font-semibold rounded-md bg-white border border-background-secondary hover:bg-background-primary">{{ __('pets.manage.edit') }}</a>
                                                <a href="{{ route('pets.show', $pet) }}"
                                                    class="px-3 py-1.5 text-sm font-semibold rounded-md bg-white border border-background-secondary hover:bg-background-primary">{{ __('pets.manage.view') }}</a>
                                                <form method="POST" action="{{ route('pets.destroy', $pet) }}"
                                                    onsubmit="return confirm('{{ $pet->is_available ? __('pets.manage.confirm_hide') : __('pets.manage.confirm_unhide') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 text-sm font-semibold rounded-md bg-white border border-background-secondary {{ $pet->is_available ? 'text-accent-red' : 'text-accent-green' }} hover:bg-background-primary">
                                                        {{ $pet->is_available ? __('pets.manage.hide') : __('pets.manage.unhide') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-3 border-t border-background-secondary">
                            {{ $pets->links() }}
                        </div>
                    @else
                        <div class="p-6 text-center">
                            <h3 class="text-2xl font-bold text-text-primary mb-2">{{ __('pets.manage.no_pets_yet') }}</h3>
                            <p class="text-text-secondary mb-6">{{ __('pets.manage.no_pets_description') }}
                            </p>
                            <a href="{{ route('pets.create') }}"
                                class="inline-block bg-accent-red hover:bg-opacity-90 text-white font-semibold py-3 px-8 rounded-md transition shadow-sm">{{ __('pets.manage.add_new') }}</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
