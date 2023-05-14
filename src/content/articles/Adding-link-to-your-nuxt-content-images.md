---
slug: adding-link-to-your-nuxt-content-images
title: 'Adding a link to your nuxt/content articles images'
description: Here is a way to add links to your articles images in your nuxt/content project so users can see them on full size.
coverImage: 
alt: adding-link-to-your-nuxt-content-images
readingTime: 4 min read
tags:
    - Nuxt
    - Nuxt Content
    - Vue
    - Blog features
navigation: false
---


## Nuxt & Nuxt Content

Nuxt is a framework for building server-side rendered (SSR) Vue.js applications. SSR means that the initial HTML is rendered on the server, and then sent to the client, which can improve the performance and search engine optimization of your application.

Nuxt provides a number of features and optimizations out of the box, such as automatic code splitting, static site generation, and hot module reloading. It also simplifies the setup of your Vue.js application, with configuration files and conventions that help you get started quickly.

Nuxt Content is a module for Nuxt that allows you to easily manage content in your application. It provides a Markdown-based syntax for writing content, and allows you to generate dynamic pages based on that content.

With Nuxt Content, you can create a blog or documentation site with ease. You can also use it to create pages for products, services, or other types of content that you want to manage dynamically.

Let's dive straight  into adding links to your articles images

## Creating a image link container component

Let's say we have a file in our project `content/articles/an-article.md`

```md
---
title: Article 1
description: this is a hello mundo article 
---

# Hello Mundo, this is an article

Some cool text here

This is a image and I wan't user to be able to open it on a blank browser tab

![HomeLab Diagram](/img/article-image.png)

```

And we have an image in our `assets/` directory, in `assets/img/article-1/article-img.png`

If we want to add the image to our article if we use markdown to added it, like `![HomeLab Diagram](/img/article-1/article-image.png)` the first problem is that the Nuxt Content module will look for images under the directory public and it will not found this one since this is on the assets folder. 

If we want to add that image to our article, we can create a component for that.

## Making the component globally available

We'll create ou component and make it globally available as this is required fot Nuxt to be able to auto import the component into our `markdown`

First, let's make sure auto import is enabled in our nuxt app, open `/nuxt.config.js`

```js
...
    // https://v3.nuxtjs.org/api/configuration/nuxt.config
    components: {
        global: true,
        dirs: ['~/components'],
    },
...
```

Let's create a new component `/components/content/ImageLinkContainer.vue`

```html
<template>
    <a 
        :href="getImageUrl()"
        :target="target" 
        class="
            flex
            flex-col
            items-center
            text-sm
            no-underline
            font-normal
            mb-16">
        <img :src="getImageUrl()" :alt="alt" class="mb-2" />
        <span v-if="legend" class="text-gray-500 -mt-2">
            {{ legend }}
        </span>
    </a>
</template>
```

In our `<script>` we'll have

```html
<script setup>

const props = defineProps({
    src: String,
    alt: String,
    legend: String,
    target:  {
        type: String,
        default: '_self'
    }
})

const getImageUrl = () => {
    try {
        const src = props.src;
        return new URL(
            `../../assets/img/${src}`,
            import.meta.url
        );
    } catch(err) {
        console.log(err);
        return null
    }
}
```

Our ImageLinkContainer component takes the following attributes `src`, `alt`, `legend` and `target`, behind the scenes our component is creating a URL of the image stored in the assets folder. We can also give it a legend that will be shown bellow our image and we can set the target of the link if you pass `_blank` the image will be opened in a new tab of the browser.

## Adding our component to our markdown 

```markdown
---
title: Article 1
description: this is a hello mundo article 
---

# Hello Mundo, this is an article

Some cool text here

This is a image and I wan't user to be able to open it on a blank browser tab

:ImageLinkContainer{src="articles/article-1/article-image.png" alt="HomeLab Diagram" target="_blank" legend="My HomeLab Diagram"}

//Or you can use
<ImageLinkContainer
    src="articles/article-1/article-image.png"
    alt="HomeLab Diagram"
    target="_blank"
    legend="My HomeLab Diagram"></ImageLinkContainer>


```

There you have it! Our component should be able to display our images for our articles wrapped in a link from the assets directory.

:ImageLinkContainer{src="articles/article-1/article-image.png" alt="HomeLab Diagram" target="_blank" legend="My HomeLab Diagram"}
:ImageLinkContainer{src="articles/article-1/move_frankdevio_to_homelab_diagram.png" alt="HomeLab Diagram" target="_blank" legend="My HomeLab Diagram"}

## Useful links

Here are some related links that I think you might find useful

- Nuxt Content Module - [Nuxt Content](https://content.nuxtjs.org/){:target="_blank"}
- How to use components in markdown - [MDC Syntax](https://content.nuxtjs.org/guide/writing/mdc){:target="_blank"}
- [Working with images in Nuxt Content | Woet Flow](https://woetflow.com/posts/working-with-images-in-nuxt-content/){:target="_blank"}

## The final result

:ImageLinkContainer{src="articles/article-1/article-image.png" alt="HomeLab Diagram" target="_blank" legend="My HomeLab Diagram"}




