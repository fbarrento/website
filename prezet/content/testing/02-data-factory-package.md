---
title: "From Laravel Factories to Framework-Agnostic: Building the Data Factory Package"
slug: testing/building-data-factory-package
excerpt: "After my last article on Laravel factories with Data Objects, I kept thinking: why should only Laravel developers get this elegant API? Here's how I built a framework-agnostic package."
date: 2025-11-12
category: testing
tags: [laravel, php, testing, packages, open-source]
image: img/ogimages/building-data-factory-package.webp
series: Laravel Factories
series_part: 2
author: francisco
---

![](building-data-factory-package.webp)

After my [last article on using Laravel factories with Data Objects](https://barrento.dev/blog/stop-writing-arrays-in-your-tests-laravel-factories-for-data-objects), I kept thinking: why should only Laravel developers get this elegant API?

If you're building framework-agnostic PHP packages, you face a problem. You need realistic test data, but you can't depend on Laravel's factory system. So you end up writing repetitive array construction code in every test, violating DRY and making maintenance a nightmare.

I built [Data Factory](https://github.com/fbarrento/data-factory) to solve this.

## The Framework-Agnostic Challenge

When you're building a PHP SDK or package that works with any framework (or no framework), test data becomes painful:

```php
// Every test looks like this
it('processes a deployment', function () {
    $deployment = [
        'id' => '123e4567-e89b-12d3-a456-426614174000',
        'status' => 'deployment.succeeded',
        'branch_name' => 'main',
        'commit_hash' => 'a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0',
        'commit_message' => 'Deploy feature X to production',
        'failure_reason' => null,
        'php_major_version' => '8.4',
        'uses_octane' => true,
        'started_at' => '2024-01-15 10:00:00',
        'finished_at' => '2024-01-15 10:05:00',
    ];
    
    // Your actual test...
});
```

Multiply this by dozens of tests, and you've got a maintenance problem. When the API structure changes, you're updating arrays scattered across your entire test suite.

Laravel developers don't have this problem. They use factories:

```php
$deployment = Deployment::factory()->succeeded()->make();
```

But that's tied to Eloquent. If you're building a package, you can't bring in the entire Laravel framework as a dev dependency just for test factories.

## The Solution: Extract the Pattern

Data Factory brings Laravel's elegant factory API to any PHP project. No framework required. No Eloquent dependency.

Here's what that same test looks like with Data Factory:

```php
it('processes a deployment', function () {
    $deployment = Deployment::factory()->succeeded()->make();
    
    // Your actual test logic - clean and focused!
});
```

One line. Clear intent. Type safe. And when the structure changes, you update one factory definition, not 50 tests.

## Building Your First Factory

Installation is simple:

```bash
composer require fbarrento/data-factory --dev
```

Then create a factory for your Data Object:

```php
use FBarrento\DataFactory\Factory;

class DeploymentFactory extends Factory
{
    protected string $dataObject = Deployment::class;
    
    protected function definition(): array
    {
        return [
            'id' => $this->fake->uuid(),
            'status' => 'pending',
            'branch_name' => 'main',
            'commit_hash' => $this->fake->sha1(),
            'commit_message' => $this->fake->sentence(),
            'php_major_version' => '8.4',
            'uses_octane' => false,
        ];
    }
}
```

The `definition()` method returns default attributes. Notice `$this->fake` - that's FakerPHP integrated out of the box for realistic test data.

The `$dataObject` property tells the factory which class to instantiate. The factory automatically uses argument unpacking to construct your object.

Wire it up to your Data Object:

```php
use FBarrento\DataFactory\Concerns\HasDataFactory;

readonly class Deployment
{
    use HasDataFactory;
    
    public function __construct(
        public string $id,
        public string $status,
        public string $branch_name,
        public string $commit_hash,
        public string $commit_message,
        public string $php_major_version,
        public bool $uses_octane,
    ) {}
    
    public static function newFactory(): DeploymentFactory
    {
        return new DeploymentFactory();
    }
}
```

The `HasDataFactory` trait provides the `factory()` method, and `newFactory()` tells it which factory class to instantiate.

Now you can use it anywhere:

```php
// Single object
$deployment = Deployment::factory()->make();

// Collection of objects
$deployments = Deployment::factory()->count(50)->make();

// Override specific attributes
$deployment = Deployment::factory()->make([
    'status' => 'failed',
    'branch_name' => 'feature/new-api',
]);
```

## States: Named Variations

States let you define common variations without repeating yourself:

```php
class DeploymentFactory extends Factory
{
    // ... definition() ...
    
    public function succeeded(): static
    {
        return $this->state([
            'status' => 'deployment.succeeded',
            'finished_at' => now(),
        ]);
    }
    
    public function failed(): static
    {
        return $this->state([
            'status' => 'deployment.failed',
            'failure_reason' => $this->fake->sentence(),
        ]);
    }
    
    public function withOctane(): static
    {
        return $this->state(['uses_octane' => true]);
    }
}
```

Then use them in your tests:

```php
it('handles successful deployments', function () {
    $deployment = Deployment::factory()->succeeded()->make();
    expect($deployment->status)->toBe('deployment.succeeded');
});

it('handles failed Octane deployments', function () {
    $deployment = Deployment::factory()
        ->failed()
        ->withOctane()
        ->make();
        
    expect($deployment->status)->toBe('deployment.failed');
    expect($deployment->uses_octane)->toBeTrue();
});
```

Compare this to manually building arrays with different statuses in every test. States make your intent clear and your tests maintainable.

## Sequences: Cycling Through Values

Sometimes you need different values for each item in a collection. Sequences handle this elegantly:

```php
$deployments = Deployment::factory()
    ->count(3)
    ->sequence(
        ['branch_name' => 'main'],
        ['branch_name' => 'staging'],
        ['branch_name' => 'feature/new-api'],
    )
    ->make();

// First deployment has branch_name = 'main'
// Second has 'staging'
// Third has 'feature/new-api'
```

This is the exact same API Laravel uses for Eloquent factories. If you know Laravel, you already know Data Factory.

## Nested Factories: Complex Object Graphs

Here's where it gets powerful. Real-world data isn't flat - it's nested. A deployment might have a user, a repository, commit details, and more.

Without factories, building nested test data is painful:

```php
$deployment = [
    'id' => '...',
    'repository' => [
        'name' => '...',
        'owner' => [
            'name' => '...',
            'email' => '...',
        ],
    ],
    'commit' => [
        'hash' => '...',
        'author' => [
            'name' => '...',
            'email' => '...',
        ],
    ],
];
```

With Data Factory, you compose factories:

```php
class DeploymentFactory extends Factory
{
    protected function definition(): array
    {
        return [
            'id' => $this->fake->uuid(),
            'repository' => Repository::factory(),
            'commit' => Commit::factory(),
        ];
    }
}

// In your test
$deployment = Deployment::factory()->make();
// Automatically creates nested Repository and Commit objects
```

You can override nested factories too:

```php
$deployment = Deployment::factory()
    ->make([
        'repository' => Repository::factory()->private()->make(),
        'commit' => Commit::factory()->make(['hash' => 'abc123']),
    ]);
```

This composition pattern keeps your test setup clean while handling arbitrarily complex object graphs.

## Array Factories: When You Don't Need Objects

Sometimes you need arrays, not objects. Maybe you're testing JSON serialization, API responses, or working with dynamic data where objects would be overkill.

Data Factory supports this through dedicated array factories:

```php
use FBarrento\DataFactory\ArrayFactory;

class DeploymentArrayFactory extends ArrayFactory
{
    protected function definition(): array
    {
        return [
            'id' => $this->fake->uuid(),
            'status' => 'pending',
            'branch_name' => 'main',
            'commit_hash' => $this->fake->sha1(),
        ];
    }
    
    public function succeeded(): static
    {
        return $this->state(['status' => 'deployment.succeeded']);
    }
}

// Single array
$deploymentArray = DeploymentArrayFactory::new()->make();
// Returns: ['id' => '...', 'status' => '...', ...]

// Collection of arrays
$deploymentsArray = DeploymentArrayFactory::new()->count(5)->make();
// Returns: [['id' => '...'], ['id' => '...'], ...]

// With states
$succeeded = DeploymentArrayFactory::new()->succeeded()->make();

```

Perfect for testing API endpoints, JSON serialization, or when you're working with unstructured data that doesn't warrant a Data Object.

## Why Framework-Agnostic Matters

When I built the [Laravel Ortto SDK](https://github.com/phpdevkits/ortto-sdk), I needed factories for testing. But I'm also building other SDKs and packages that aren't Laravel-specific.

Data Factory works with:
- ✅ Laravel projects (alongside Eloquent factories)
- ✅ Symfony projects
- ✅ Framework-agnostic PHP packages
- ✅ Plain PHP projects with PEST or PHPUnit

The API is familiar to Laravel developers, but you don't need Laravel. You get the elegant factory pattern everywhere.

## Real-World Usage

In the Laravel Cloud SDK I'm building, I use Data Factory extensively:

```php
class ServerFactory extends Factory
{
    protected function definition(): array
    {
        return [
            'id' => $this->fake->uuid(),
            'name' => $this->fake->word(),
            'region' => $this->fake->randomElement(['us-east-1', 'eu-west-1']),
            'size' => 'small',
            'status' => 'active',
            'ipAddress' => $this->fake->ipv4(),
        ];
    }
    
    public function provisioning(): static
    {
        return $this->state(['status' => 'provisioning']);
    }
    
    public function large(): static
    {
        return $this->state(['size' => 'large']);
    }
}

// In tests
it('lists active servers', function () {
    $servers = Server::factory()->count(10)->make();
    // Test logic...
});

it('handles server provisioning', function () {
    $server = Server::factory()->provisioning()->large()->make();
    expect($server->status)->toBe('provisioning');
    expect($server->size)->toBe('large');
});
```

Clean. Readable. Maintainable. And when the Cloud API changes their server structure, I update one factory, not dozens of tests.

## What's Next

Data Factory is on [Packagist](https://packagist.org/packages/fbarrento/data-factory) and actively maintained. The package has:
- ✅ 100% test coverage
- ✅ 100% type coverage (PHPStan level 9)
- ✅ Comprehensive documentation
- ✅ PHP 8.2+ with modern patterns

I'm considering these features for future releases:
- `raw()` method for returning attribute arrays without instantiating objects
- `afterMaking()` callbacks for post-processing
- Export to JSON fixtures
- Streaming/chunking for massive datasets

In the next article, we'll dive into advanced patterns: managing relationships between factories, custom faker providers, and testing strategies with complex object graphs.

Check out [Data Factory on GitHub](https://github.com/fbarrento/data-factory) and give it a try. If you're building PHP packages or SDKs, it'll change how you write tests.

Stop writing arrays. Start using factories. Everywhere.
