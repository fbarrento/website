<div class="py-2">
    @if (! $subscribed)
        <form wire:submit="subscribe">
            <div class="flex flex-col justify-center space-y-2">
                <label class="relative min-w-[240px] flex-1 items-center">
                    <div class="flex w-full flex-wrap items-stretch gap-4">
                        <span class="sr-only">Email</span>
                        @if ($errors->has('email'))
                            @svg('lucide-circle-x', ['class' => 'absolute top-1/2 left-3 h-6 w-6 -translate-y-1/2 text-red-500'])
                        @else
                            @svg('bi-envelope-at', ['class' => 'absolute top-1/2 left-3 h-6 w-6 -translate-y-1/2 text-gray-600 dark:text-gray-400'])
                        @endif
                        <!-- Honeypot field -->
                        <input
                            type="text"
                            name="website"
                            wire:model="honeypot"
                            class="hidden"
                            tabindex="1"
                            autocomplete="off"
                        />
                        <input
                            type="email"
                            wire:model="email"
                            placeholder="Enter your email"
                            required
                            @class([
                                'w-full flex-1 rounded-lg border px-12 py-3 transition focus:ring-2 focus:ring-offset-2 focus:outline-none',
                                'focus:ring-primary-600/80 border-gray-200 bg-transparent text-gray-600 placeholder-gray-600/50 focus:border-gray-100 focus:bg-gray-100/40 dark:border-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-gray-600 dark:focus:bg-gray-800/40' => ! $errors->has(
                                    'email',
                                ),
                                'border-red-300 bg-red-50/50 text-red-900 placeholder-red-400 focus:border-red-500 focus:ring-red-500 dark:border-red-700 dark:bg-red-900/20 dark:text-red-300' => $errors->has(
                                    'email',
                                ),
                            ])
                        />
                        <x-button class="flex gap-2">
                            <span wire:loading.remove>Subscribe</span>
                            <span wire:loading>Subscribing...</span>
                            <div wire:loading>
                                @svg('lucide-loader-circle', ['class' => 'h-5 w-5 animate-spin text-white/90'])
                            </div>
                        </x-button>
                    </div>
                </label>
                @error('email')
                    <div
                        class="flex items-center gap-2 rounded-md bg-red-50 px-3 py-2 text-sm text-red-800 dark:bg-red-900/20 dark:text-red-300"
                    >
                        @svg('lucide-alert-circle', ['class' => 'h-4 w-4 flex-shrink-0'])
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </form>
    @else
        <x-newsletter.success />
    @endif
</div>
