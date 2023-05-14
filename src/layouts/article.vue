<template>
    <div>
        <header class="pt-20">
            <NavBar />
        </header>
        <main class="px-4 md:px-0">
            <div class="container mx-auto max-w-2xl">
                <slot />
            </div>
        </main>
    </div>
</template>