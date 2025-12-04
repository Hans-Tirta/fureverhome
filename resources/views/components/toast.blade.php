@if (session('success') || session('error') || session('info'))
    <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2">
        @if (session('success'))
            <div
                class="toast-item flex items-center gap-3 bg-white rounded-lg shadow-lg border-l-4 border-accent-green p-4 min-w-[300px] max-w-md animate-slide-in">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-accent-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-text-primary">Success</p>
                    <p class="text-sm text-text-secondary">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()"
                    class="flex-shrink-0 text-text-muted hover:text-text-secondary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="toast-item flex items-center gap-3 bg-white rounded-lg shadow-lg border-l-4 border-accent-red p-4 min-w-[300px] max-w-md animate-slide-in">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-accent-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-text-primary">Error</p>
                    <p class="text-sm text-text-secondary">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()"
                    class="flex-shrink-0 text-text-muted hover:text-text-secondary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('info'))
            <div
                class="toast-item flex items-center gap-3 bg-white rounded-lg shadow-lg border-l-4 border-accent-blue p-4 min-w-[300px] max-w-md animate-slide-in">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-accent-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-text-primary">Info</p>
                    <p class="text-sm text-text-secondary">{{ session('info') }}</p>
                </div>
                <button onclick="this.parentElement.remove()"
                    class="flex-shrink-0 text-text-muted hover:text-text-secondary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <script>
        // Auto-dismiss toast after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast-item');
            toasts.forEach(toast => {
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    toast.style.transition = 'all 0.3s ease-out';
                    setTimeout(() => toast.remove(), 300);
                }, 5000);
            });
        });
    </script>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>
@endif
