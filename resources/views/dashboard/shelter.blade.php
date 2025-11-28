<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-text-primary">
                <h3 class="text-2xl font-semibold mb-2">Welcome,
                    {{ auth()->user()->shelter->name ?? auth()->user()->name }}!</h3>
                <p class="text-text-secondary">Manage your shelter, pets, and adoption requests from this dashboard.</p>
            </div>
        </div>
    </div>
</div>
