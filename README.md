# barrento.dev

Personal website and tech blog built with Laravel 12 and Prezet.

## Tech Stack

- **Laravel 12** with streamlined bootstrap structure
- **Prezet** for markdown-based content management
- **Tailwind CSS v4** with `@import "tailwindcss"` syntax
- **Alpine.js** for interactive components
- **Livewire 4** for dynamic server-rendered UI
- **Vite 7** for asset bundling
- **Pest 4** for testing
- **Laravel Herd** for local development

## Features

- **Markdown-based blogging** powered by Prezet with YAML front matter
- **Multiple content types** — articles, category landing pages, standalone pages, reusable blocks, video posts, and project showcases
- **Newsletter subscription** via Brevo (formerly Sendinblue), with inline and card signup components
- **Embeddable rich media** — YouTube videos, Threads posts, and alert callouts directly in markdown
- **Responsive images** with automatic srcset generation at multiple widths
- **Full-text search** across all published content
- **SEO/JSON-LD structured data** with per-author and publisher metadata
- **Dark mode** with Tailwind CSS `dark:` variant support
- **Syntax highlighting** via Phiki (NightOwl theme) with line numbers
- **Sitemap generation** for search engine indexing
- **OG image generation** for social sharing

## Prerequisites

- PHP 8.2+
- Composer
- Node.js and npm
- [Laravel Herd](https://herd.laravel.com) (recommended for local dev)

## Getting Started

```bash
git clone <repo-url> && cd website
composer setup
php artisan prezet:index
```

`composer setup` runs: dependency install, `.env` creation, key generation, database migration, npm install, and asset build.

`php artisan prezet:index` rebuilds the content index from the markdown files.

## Development

```bash
# Start everything (server, queue, logs, vite) concurrently
composer run dev

# Vite watch only
npm run dev

# Production build
npm run build
```

## Testing

```bash
# Run all tests
php artisan test

# Or via Composer
composer test

# Run a specific test file
php artisan test tests/Feature/ExampleTest.php

# Filter by test name
php artisan test --filter=testName
```

## Code Quality

```bash
# Format changed files
vendor/bin/pint --dirty

# Format everything
vendor/bin/pint
```

## Content Architecture

All content is managed through Prezet as markdown files with YAML front matter. Newsletter subscriptions are handled by Brevo via `app/Actions/SubscribeNewsletter.php` and `app/Services/Brevo.php`, with signup components embedded in article and index pages.

- **Content** lives in `prezet/content/`
- **Images** live in `prezet/images/`

### Content Types

Defined in `app/Data/ExtendedFrontmatterData.php`, the `contentType` front matter field determines how content is routed and rendered:

| Type | Description | URL Pattern |
|------|-------------|-------------|
| `article` | Blog posts (default if omitted) | `/blog/{slug}` |
| `category` | Landing page that groups articles by category | `/blog/{slug}` |
| `page` | Standalone pages | `/{slug}` |
| `block` | Reusable content blocks embedded in other views (e.g. the about block on the homepage) | Not directly routable |
| `video` | Video content | `/blog/{slug}` |
| `project` | Project showcases | `/blog/{slug}` |

### Optional Fields

- **`type`** — `sdk`, `website`, or `webapp`
- **`theme`** — `default` or `vibrant`

## Creating New Content

### Articles

Articles can be organized in two ways:

**By subcategory under `articles/`** — `prezet/content/articles/{subcategory}/{nn-slug}/index.md`:

```
prezet/content/articles/packages/01-laravel-cloud-sdk/index.md
prezet/content/articles/packages/02-data-factory-package/index.md
```

**By top-level category folder** — `prezet/content/{category}/{nn-slug}/index.md`:

```
prezet/content/testing/01-stop-writing-arrays/index.md
```

Both patterns produce articles. The `contentType` field defaults to `article` when omitted, so most articles don't need to set it explicitly.

Front matter example:

```yaml
---
title: "Your Article Title"
date: 2025-12-01
excerpt: A short description for cards and SEO.
image: /img/ogimages/your-article.webp
author: francisco
category: testing
tags:
  - laravel
  - php
slug: your-article-slug
---

Your markdown content here.
```

Place associated images alongside the content or in `prezet/images/`. For example, images for articles under `articles/packages/` go in `prezet/images/articles/packages/`, and images for testing articles go in `prezet/images/testing/`.

### Pages

Create a markdown file at `prezet/content/pages/{slug}.md`:

```yaml
---
title: Page Title
date: 2025-12-01
excerpt: Short description.
slug: page-slug
contentType: page
---

Page content here.
```

### Blocks

Create a markdown file at `prezet/content/blocks/{name}.md`:

```yaml
---
title: Block Title
date: 2025-12-01
excerpt: Short description.
contentType: block
draft: false
author: francisco
---

Block content here.
```

### Category Landing Pages

Create a markdown file that groups articles under a category:

```yaml
---
title: Complete Guide to Testing in Laravel
date: 2025-01-10
category: Testing
excerpt: Description of the category.
slug: testing
contentType: category
---

Introductory content shown above the article list.
```

### Videos

Video posts use the same `ShowController` and `prezet.show` view as articles. Create a markdown file with `contentType: video`:

```yaml
---
title: "Video Title"
date: 2025-12-01
excerpt: Short description.
author: francisco
contentType: video
slug: video-slug
tags:
  - laravel
---

Introductory text, followed by a YouTube embed:

<x-prezet::youtube videoid="dQw4w9WgXcQ" title="Video Title" />
```

### Projects

Project showcases follow the same pattern. Create a markdown file with `contentType: project`:

```yaml
---
title: "Project Name"
date: 2025-12-01
excerpt: What the project does.
author: francisco
contentType: project
type: sdk
slug: project-slug
tags:
  - open-source
---

Project description and details here.
```

The `type` field (`sdk`, `website`, or `webapp`) can further classify projects.

### Embeddable Components

Prezet's `MarkdownBladeExtension` allows you to use Blade components directly inside markdown content.

**YouTube embed** — lazy-loaded via lite-youtube:

```html
<x-prezet::youtube videoid="dQw4w9WgXcQ" title="Video Title" />
```

**Threads post embed**:

```html
<x-prezet::threads username="fbarrento" id="C-yDq7mS5II" />
```

**Alert/callout boxes** — types: `info` (default), `success`, `warning`, `error`:

```html
<x-prezet::alert type="warning" title="Heads up" body="This is a warning message." />
```

### After Creating Content

Rebuild the content index so new files are picked up:

```bash
php artisan prezet:index
```

## Front Matter Reference

| Field | Required | Description |
|-------|----------|-------------|
| `title` | Yes | Document title |
| `date` | Yes | Publication date (`YYYY-MM-DD`) |
| `excerpt` | Yes | Short description for cards, feeds, and SEO |
| `image` | No | Path to the OG/hero image |
| `author` | No | Author key from `config/prezet.php` |
| `category` | No | Category slug |
| `tags` | No | List of tag strings |
| `slug` | No | URL slug (defaults from filepath or title per config) |
| `contentType` | No | One of: `article`, `category`, `page`, `block`, `video`, `project` (defaults to `article`) |
| `draft` | No | Set to `true` to hide from public views |
| `type` | No | `sdk`, `website`, or `webapp` |
| `theme` | No | `default` or `vibrant` |

## Routes

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | Homepage |
| GET | `/blog` | Article index (supports `?category`, `?tag`, `?author` filters) |
| GET | `/blog/{slug}` | Article, category landing, or video |
| GET | `/{slug}` | Standalone page |
| GET | `/search` | Full-text search |
| GET | `/img/{path}` | Responsive image serving |
| GET | `/ogimage/{slug}` | OG image generation |

## Authors

Authors are configured in `config/prezet.php` under the `authors` key. Reference them by key in front matter:

```yaml
author: francisco
```

Currently defined authors: `francisco`, `prezet`.

## Directory Structure

```
prezet/
  content/
    articles/           # Blog posts, organized by subcategory
      packages/         #   e.g. SDK and package articles
    blocks/             # Reusable content blocks (about, etc.)
    pages/              # Standalone pages (sponsor, etc.)
    testing/            # Testing-related articles (top-level category)
  images/               # Content images
    articles/           #   Article images by subcategory
    testing/            #   Testing article images
    ogimages/           # Open Graph images
  backup/               # Archived sample content

app/
  Actions/              # SubscribeNewsletter
  Data/
    ExtendedFrontmatterData.php
  Enums/                # LivewireEvents
  Http/Controllers/
    Prezet/             # IndexController, ShowController, PageController,
                        #   SearchController, ImageController, OgimageController
    HomeController.php
  Services/             # Brevo (newsletter API)

resources/views/
  prezet/               # index, show, page, category, ogimage templates
  components/
    prezet/             # Blade components: youtube, threads, alert, article,
                        #   header, nav, sidebar, search, dark-mode-toggle, etc.
    newsletter/         # inline and card subscription components

config/
  prezet.php            # Authors, markdown extensions, image config, sitemap
```
