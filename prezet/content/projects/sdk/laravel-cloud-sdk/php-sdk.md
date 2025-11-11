---
title: "Laravel Cloud SDK"
date: 2025-11-08
excerpt: A fully-typed, production-ready PHP SDK for Laravel Cloud API. Built with Saloon, Lawman, and PEST for maximum type safety and test coverage.
image: /img/ogimages/laravel-cloud-sdk.webp
author: francisco
tags:
  - laravel
  - laravel-cloud
  - php
  - sdk
content_type: project
type: sdk
theme: vibrant
slug: laravel-cloud-sdk/php-sdk
---

![](laravel-cloud-sdk.webp)

## Overview

The Laravel Cloud SDK is a fully-typed, production-ready PHP SDK for interacting with the Laravel Cloud API. Built with modern PHP practices and inspired by Laravel's commitment to developer experience.

## Features

- **Saloon Powered** - Battle-tested HTTP abstraction with request/response pipelines
- **Type Safe** - Backed enums, strict mode, and value objects for every response
- **100% Coverage** - PEST powered testing keeps integrations confident
- **Clean Architecture** - Lawman keeps boundaries sharp and responsibilities clear

## Architecture

The SDK is built on three core layers:

### Laravel Cloud Platform
**Laravel Cloud API** - Applications · Deployments · Domains · Commands · Instances · WebSockets · Databases

### Community SDK
**Laravel Cloud SDK** - Saloon powered http core, Lawman architecture validation, test-first workflows.

### Your Applications
**Framework agnostic delivery** - Laravel, Symfony, and pure PHP projects share the same type-safe experience.

## Installation

```bash
composer require phpdevkits/laravel-cloud-sdk
```

## Quick Start

```php
use Phpdevkits\LaravelCloudSdk\LaravelCloud;

$cloud = new LaravelCloud(apiToken: 'your-token');

$applications = $cloud->applications()->list();
```

## Resources

- **Applications & Environments** - Manage your Laravel Cloud applications
- **Deployments & Domains** - Handle deployments and domain configurations
- **Commands & Background Processes** - Execute commands and manage processes
- **Database Backups & Instances** - Manage database resources
- **WebSocket Clusters** - Real-time communication support

## Standards

1. **100% test coverage** - Every feature tested comprehensively
2. **Full type safety** - No mixed types, strict mode everywhere
3. **Clear documentation** - Explain not just what, but why
4. **Clean architecture** - Patterns that make sense and scale

## Repository

Built in the open at [GitHub](https://github.com/phpdevkits/laravel-cloud-sdk).

## License

MIT

