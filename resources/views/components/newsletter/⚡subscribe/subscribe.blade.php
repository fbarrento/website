<div class="py-2">
    @if (! $subscribed)
        <form wire:submit="subscribe">
            <div class="flex flex-col space-y-3">
                <input
                    type="text"
                    name="website"
                    wire:model="website"
                    tabindex="-1"
                    autocomplete="off"
                    class="absolute top-0 left-0 -z-10 h-0 w-0 opacity-0"
                    aria-hidden="true"
                />

                <div class="flex flex-col gap-3 sm:flex-row">
                    <label class="relative flex-1">
                        <span class="sr-only">Email address</span>
                        @svg('lucide-mail', ['class' => 'pointer-events-none absolute top-1/2 left-3.5 h-5 w-5 -translate-y-1/2 text-zinc-400 dark:text-zinc-500'])
                        <input
                            type="email"
                            wire:model="email"
                            placeholder="your@email.com"
                            required
                            class="focus:border-primary-500 focus:ring-primary-500/20 dark:focus:border-primary-400 dark:focus:ring-primary-400/20 h-12 w-full rounded-lg border border-zinc-200 bg-white pr-4 pl-11 text-zinc-900 placeholder-zinc-400 shadow-sm transition duration-200 focus:ring-2 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder-zinc-500"
                        />
                    </label>

                    <button
                        type="submit"
                        class="group bg-primary-600 hover:bg-primary-700 focus-visible:ring-primary-600 dark:bg-primary-600 dark:hover:bg-primary-500 dark:focus-visible:ring-primary-500 inline-flex h-12 items-center justify-center gap-2 rounded-lg px-6 font-semibold whitespace-nowrap text-white shadow-sm transition-all duration-200 hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Subscribe</span>
                        <span wire:loading class="flex items-center gap-2">
                            @svg('lucide-loader-circle', ['class' => 'h-5 w-5 animate-spin'])
                            <span>Subscribing...</span>
                        </span>
                    </button>
                </div>

                @error('email')
                    <div
                        class="flex items-start gap-2 rounded-lg bg-red-50 p-3 text-sm text-red-700 dark:bg-red-950/30 dark:text-red-400"
                    >
                        @svg('lucide-circle-x', ['class' => 'mt-0.5 h-4 w-4 flex-shrink-0'])
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </form>
    @else
        <div class="bg-primary-50 dark:bg-primary-950/30 flex items-start gap-3 rounded-lg p-4 text-sm">
            @svg('lucide-circle-check', ['class' => 'text-primary-600 dark:text-primary-400 mt-0.5 h-5 w-5 flex-shrink-0'])
            <div>
                <p class="text-primary-900 dark:text-primary-100 font-semibold">Thanks for subscribing!</p>
                <p class="text-primary-700 dark:text-primary-300 mt-1">Check your inbox for confirmation.</p>
            </div>
        </div>
    @endif
</div>
