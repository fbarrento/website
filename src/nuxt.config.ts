// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
    experimental: {
        writeEarlyHints: false,
    },

    components: {
      global: true,
      dirs: ['~/components'],
    },

    modules: [
        "@nuxt/content",
        "@nuxtjs/tailwindcss"
    ],

    content: {
        highlight: {
          theme: {
            // Default theme (same as single string)
            default: 'github-light',
            // Theme used if `html.dark`
            dark: 'github-dark',
            // Theme used if `html.sepia`
            sepia: 'monokai'
          },
          preload: [
            'c',
            'cpp',
            'java',
            'php',
            'python'
          ]
        }
      }

})
