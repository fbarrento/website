<!-- Optimized Newsletter Component - Inline Style -->
<div
    class="my-8 rounded-lg border-l-4 border-blue-500 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 shadow-sm dark:from-blue-900/20 dark:to-indigo-900/20"
>
    <div class="mb-4 flex items-start gap-3">
        <div class="flex-shrink-0">
            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Building SDKs for Underserved Services</h3>
            <p class="mt-2 text-gray-700 dark:text-gray-300">
                Join
                <span class="font-semibold text-blue-600 dark:text-blue-400">100+ developers</span>
                getting updates on new SDKs, Laravel tips, and package development.
            </p>
        </div>
    </div>

    <div class="lg:shrink-0">
        <livewire:newsletter.subscribe />
        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">No spam. Unsubscribe anytime.</p>
    </div>
</div>
