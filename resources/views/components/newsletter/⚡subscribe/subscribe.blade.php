<div class="py-2">
    @if (! $subscribed)
        <form wire:submit="subscribe">
            <div class="flex flex-col justify-center space-y-2">
                <label class="relative min-w-[240px] flex-1 items-center">
                    <div class="flex w-full flex-wrap items-stretch gap-4">
                        <span class="sr-only">Email</span>
                        @svg('bi-envelope-at', ['class' => 'absolute top-1/2 left-3 h-6 w-6 -translate-y-1/2 text-gray-600 dark:text-gray-400'])
                        <input
                            type="email"
                            wire:model="email"
                            placeholder="Enter your email"
                            required
                            class="w-full flex-1 rounded-lg border-gray-200 bg-transparent px-12 py-3 text-gray-600 placeholder-gray-600/50 transition focus:border-gray-100 focus:bg-gray-100/40 focus:ring-2 focus:ring-primary-600/80 focus:ring-offset-2 focus:outline-none dark:border-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-gray-600 dark:focus:bg-gray-800/40"
                        />
                        <x-button class="flex gap-2">
                            Subscribe
                            <div wire:loading>
                                @svg('lucide-loader-circle', ['class' => 'h-5 w-5 animate-spin text-white/90'])
                            </div>
                        </x-button>
                    </div>
                </label>
                <div>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>
    @else
        <p>Thanks for subscribing! Check your inbox for confirmation.</p>
    @endif
</div>
