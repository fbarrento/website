# Hello Mundo!

The first content of the [Frankdev.io](https://frankdev.io) website. And it will change a lot since I'll be building and writing and I'm doing at the same time.

## The Plan

1. Develop with [Nuxt 3](https://v3.nuxtjs.org){:target="\_blank"};
2. Use [Nuxt Content](https://content.nuxtjs.org/){:target="\_blank"} to manage the content;
3. Use [Github](https://github.com/fbarrento/Website){:target="\_blank"} as Source Control;
4. Follow Git Flow to manage the website lifecycle;
5. Use GitHub actions to build a Docker Image and publish it to a Azure Container Registry;
6. Deploy the website to a staging and production Kubenetes Cluster with [FluxCD](https://fluxcd.io/){:target="\_blank"};
7. Start to write some cool content.

## First things first

After I created the GitHub repo, the nuxt project, installed the Nuxt Content and created the Dockerfile it's time to setup the GitHub Actions to build and publish the docker image.

How it's going to work?

When code is merged to the develop branch, to a features branch or to the main branch we will trigger a Github Action to build the Docker image and publish it to the Azure Container Registry.

Each of this actions will build and publish images with 3 different tags. The develop branch will build a image with a tag like `dev-$(BuildId)`. The features branches will build a docker image with a tag like `alpha-1.0.0-$(BuildId)`, this images will be used to deploy the website to the staging environment. The main branch will build a image with a tag like `1.0.0-$(BuildId)`.
