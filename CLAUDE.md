# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application using Prezet (a markdown-based blogging system) with Tailwind CSS v4 and Alpine.js for the frontend. The application is served locally via Laravel Herd.

## Common Commands

### Development
```bash
# Start the development server (runs server, queue, logs, and vite concurrently)
composer run dev

# Build frontend assets
npm run build

# Watch frontend assets for changes
npm run dev
```

### Testing
```bash
# Run all tests
php artisan test
# Or
composer test

# Run tests in a specific file
php artisan test tests/Feature/ExampleTest.php

# Run specific test by name
php artisan test --filter=testName
```

### Code Quality
```bash
# Format code with Laravel Pint (run before finalizing changes)
vendor/bin/pint --dirty

# Format all code
vendor/bin/pint
```

### Initial Setup
```bash
# Complete project setup (install dependencies, generate key, migrate, build assets)
composer setup
```

## Architecture

### Prezet Blogging System

Prezet is the primary feature of this application. It provides a markdown-based blogging system with:

- **Content Storage**: Markdown files stored in `storage/prezet/` (via the 'prezet' filesystem disk)
- **Routes**: All Prezet routes are defined in `routes/prezet.php` and prefixed with `/prezet`
- **Controllers**: Located in `app/Http/Controllers/Prezet/` handling index, show, search, images, and og:images
- **Views**: Blade templates in `resources/views/prezet/` and components in `resources/views/components/prezet/`
- **Configuration**: `config/prezet.php` controls markdown parsing, image handling, authors, and SEO

Key Prezet features:
- CommonMark markdown parser with extensions for headings, external links, front matter
- Responsive image generation with configurable widths
- Syntax highlighting via Phiki (NightOwl theme)
- Structured data (JSON-LD) for SEO with author and publisher metadata
- Sitemap generation

### Frontend Stack

- **Tailwind CSS v4**: Uses `@import "tailwindcss"` syntax (not `@tailwind` directives)
- **Alpine.js**: For interactive components
- **Vite**: Asset bundler configured in `vite.config.js`

### Laravel 12 Structure

This project uses Laravel 12's streamlined structure:
- Middleware, exceptions, and routing configured in `bootstrap/app.php`
- Service providers in `bootstrap/providers.php`
- No `app/Http/Middleware/` or `app/Console/Kernel.php`
- Console commands auto-register from `app/Console/Commands/`

### Routes

- `routes/web.php`: Main application routes (currently just homepage and includes Prezet routes)
- `routes/prezet.php`: All Prezet-related routes (search, images, blog index/show)
- `routes/console.php`: Artisan console commands

## Key Conventions

### Prezet Content

When working with blog content:
- Markdown files use front matter for metadata (title, slug, author, category, tags, etc.)
- Authors are defined in `config/prezet.php` under the 'authors' key (francisco, bob, jane, prezet)
- Images should be placed relative to content and reference authors/metadata from config
- Slugs can be generated from filepath or title (configured in `config/prezet.php`)

### Frontend

- Dark mode should be supported using Tailwind's `dark:` prefix
- Use gap utilities for spacing in flex/grid layouts, not margins
- Follow existing Prezet component patterns in `resources/views/components/prezet/`

### Testing

- All tests use Pest v4
- Feature tests in `tests/Feature/`, unit tests in `tests/Unit/`
- Browser tests should go in `tests/Browser/` (Pest v4 browser testing available)