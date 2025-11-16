<div
    id="newsletter"
    class="border-primary-500 from-primary-50/50 to-primary-100/30 ring-primary-500/10 dark:border-primary-600 dark:from-primary-950/20 dark:to-primary-900/10 dark:ring-primary-400/20 my-8 rounded-xl border-l-4 bg-gradient-to-r p-6 ring-1 ring-inset"
>
    <div class="mb-5 flex items-start gap-3">
        <div class="mt-0.5 flex-shrink-0">
            @svg('lucide-mail', ['class' => 'text-primary-600 dark:text-primary-400 h-6 w-6', 'aria-hidden' => 'true'])
        </div>
        <div class="min-w-0 flex-1">
            <h3 class="text-xl leading-tight font-bold text-zinc-900 dark:text-white">
                Building SDKs for Underserved Services
            </h3>
            <p class="mt-2.5 leading-relaxed text-zinc-700 dark:text-zinc-300">
                Join
                <strong class="text-primary-600 dark:text-primary-400 font-semibold">100+ developers</strong>
                getting updates on new SDKs, Laravel tips, and package development.
            </p>
        </div>
    </div>

    <div class="space-y-3">
        <livewire:newsletter.subscribe />
        <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">No spam. Unsubscribe anytime.</p>
    </div>
</div>
