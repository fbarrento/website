---
title: "Building a Fully-Typed Laravel Cloud SDK: A Learning Journey"
date: 2025-11-08
excerpt: Laravel Cloud has been running production workloads since February. Last week, they announced their API is now available.
image: /img/ogimages/2025-11-08-build-a-fully-typed-laravel-cloud-sdk-a-learning-journey.webp
author: francisco
tags: [laravel, laravel-cloud, php, sdk]
slug: build-a-fully-typed-laravel-cloud-sdk-a-learning-journey
---

![[build-a-fully-typed-laravel-cloud-sdk-a-learning-journey.png]]

Laravel Cloud just announced their API is available. As someone who's been inspired by how the Laravel team builds incredible tools, I saw this as the perfect opportunity to learn how to build a production-quality SDK.

So I started [phpdevkits/laravel-cloud-sdk](https://github.com/phpdevkits/laravel-cloud-sdk) to learn and contribute back to this community that's given us so much.

## What I'm Learning

Building a proper SDK is hard. Really hard. The Laravel team makes it look easy, but there's so much that goes into it:

- **Type safety everywhere** - PHP 8.4+ strict types, backed enums, full type coverage
- **Testing at scale** - Maintaining 100% coverage with PEST while keeping tests readable
- **Clean architecture** - Using Saloon for HTTP, Lawman for architecture validation
- **Framework agnostic design** - Pure PHP that works anywhere

The foundation is there, but there's so much more to build and learn from.

## What Needs Building

The Laravel Cloud API is beautiful - it covers everything you need:
- Applications & Environments
- Deployments & Domains  
- Commands & Background Processes
- Database Backups & Instances
- WebSocket Clusters (just announced!)

Each resource is an opportunity to learn:
- How to design intuitive APIs
- How to handle complex Request/Response transformations
- How to write comprehensive tests that actually help
- How to document in a way that makes sense

## Why This Matters to Me

Laravel has taught me so much about what good developer experience looks like. Every package, every tool - there's a thoughtfulness to it that I want to understand better.

Building this SDK is my way of:
- Deepening my understanding of API design
- Contributing something useful back to the community
- Learning from anyone who wants to pair on it
- Creating educational content about the process

If the Laravel team eventually builds an official SDK, amazing! I'll learn even more from seeing how they approach it. And if this becomes useful to others in the meantime, even better.

## Join the Learning Journey

I'm building this in the open at [GitHub](https://github.com/phpdevkits/laravel-cloud-sdk). If you're interested in learning how to build production-quality SDKs, or if you've built them before and want to share knowledge, I'd love to collaborate.

The standards I'm trying to maintain:
1. **100% test coverage** - Every feature tested comprehensively
2. **Full type safety** - No mixed types, strict mode everywhere
3. **Clear documentation** - Explain not just what, but why
4. **Clean architecture** - Patterns that make sense and scale

This is about learning from the best community in PHP. Laravel has shown us what's possible when you care about developers. Let's see what we can learn by building something inspired by that standard.

Interested in learning together?

