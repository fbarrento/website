<!-- Success State - More Engaging -->
<div class="rounded-lg border border-green-200 bg-green-50 p-6 dark:border-green-800 dark:bg-green-900/20">
    <div class="flex items-start gap-3">
        <div class="flex-shrink-0">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-800">
                @svg('lucide-check-circle', ['class' => 'h-6 w-6 text-green-600 dark:text-green-400'])
            </div>
        </div>
        <div class="flex-1">
            <h3 class="mb-1 text-lg font-semibold text-green-900 dark:text-green-100">You're subscribed! 🎉</h3>
            <p class="mb-3 text-sm text-green-800 dark:text-green-200">
                Check your inbox for a confirmation email. You'll get updates on new SDKs, Laravel tips, and package
                development.
            </p>
            <div class="flex flex-wrap gap-2">
                <a
                    href="{{ route('prezet.index') }}"
                    class="inline-flex items-center gap-1 text-sm font-medium text-green-700 hover:text-green-800 dark:text-green-300 dark:hover:text-green-200"
                >
                    Read more articles
                    @svg('lucide-arrow-right', ['class' => 'h-4 w-4'])
                </a>
                <span class="text-green-400 dark:text-green-600">•</span>
                <a
                    href="https://github.com/phpdevkits"
                    class="inline-flex items-center gap-1 text-sm font-medium text-green-700 hover:text-green-800 dark:text-green-300 dark:hover:text-green-200"
                    target="_blank"
                >
                    View SDKs
                    @svg('lucide-external-link', ['class' => 'h-4 w-4'])
                </a>
            </div>
        </div>
    </div>
</div>
