<template>
    <div>
        <header class="pt-20">
            <NavBar />
            <slot name="hero" />
        </header>
        <main class="px-4 md:px-0">
            <div class="container mx-auto">
                <slot />
            </div>
        </main>
    </div>
</template>