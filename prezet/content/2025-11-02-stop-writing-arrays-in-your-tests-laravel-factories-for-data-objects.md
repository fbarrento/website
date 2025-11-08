---
title: "Stop Writing Arrays in Your Tests: Laravel Factories for Data Objects"
date: 2025-11-02
excerpt: "Building the Laravel Orrto SDK taught me something: test setup shouldn't be harder than the actual testing. When you are integrating with an API that expects complex, nested payloads, raw arrays turn your tests into unreadable nightmares fast."
image: /img/ogimages/stop-writing-arrays-in-your-tests-laravel-factories-for-data-objects.webp
author: francisco
tags:
  - factories
  - data-objects
  - tests
slug: stop-writing-arrays-in-your-tests-laravel-factories-for-data-objects
---

![](stop-writing-arrays-in-your-tests-laravel-factories-for-data-objects.webp)

Building the [Laravel Ortto SDK](https://github.com/phpdevkits/ortto-sdk) taught me something: test setup shouldn't be harder than the actual testing. When you are integrating with an API that expects complex, nested payloads, raw arrays turn your tests into unreadable nightmares fast.

Here's what I mean. The Ortto API's person merge endpoint expects payloads like this:

```php
$payload = [
    'people' => [
        [
            'fields' => [
                'str::ei' => 'user_12345',
                'str::email' => 'francisco.barrento@gmail.com',
                'str::first' => 'Francisco',
                'str::last' => 'Barrento',
                'geo::city' => ['name' => 'Lisbon'],
                'geo::country' => ['name' => 'Portugal'],
                'str::postal' => '1000-001',
                'bol::p' => true,
                'bol::sp' => false,
            ]
        ],
        [
            'fields' => [
                'str::ei' => 'user_67890',
                'str::email' => 'another@example.com',
                'str::first' => 'Jane',
                'str::last' => 'Smith',
                'geo::city' => ['name' => 'Porto'],
                'geo::country' => ['name' => 'Portugal'],
                'str::postal' => '4000-001',
                'bol::p' => true,
                'bol::sp' => true,
            ]
        ],
        // ... imagine 52 more of these
    ]
];
```

Now multiply that by every test case that needs person data. Different scenarios, edge cases, validation tests. You're writing the same structure dozens of times, changing a field here and there. When the API structure changes (and it will), you're updating arrays scattered across 30 test files.

There's a better way.

## The Pattern That Changed Everything

What if instead of building arrays manually, you could write:

```php
$people = PersonData::factory()->count(54)->make();

$payload = [
    'people' => $people->toArray()
];
```

That's it. Fifty-four realistic person objects with random, valid data. One line. And when the structure changes, you update one factory definition, not 30 tests.

This is what Laravel's factory pattern does for Eloquent models, but we can hijack it for Data Objects.

## Setting Up Factories for Data Objects

First, we need a Data Object. Mine implements Laravel's `Arrayable` interface because our HTTP client (Saloon) transforms arrays into JSON payloads for the API:

```php
class PersonData implements Arrayable
{
    public function __construct(
        public string|int $id,
        public string $email,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $name = null,
        public ?string $city = null,
        public ?string $country = null,
        public ?string $postalCode = null,
        public ?CarbonImmutable $birthdate = null,
        public bool $emailPermission = false,
        public bool $smsPermission = false,
    ) {}

    public static function factory(): PersonFactory
    {
        return PersonFactory::new();
    }

    public function toArray(): array
    {
        return [
            'fields' => [
                'str::ei' => (string) $this->id,
                'str::email' => $this->email,
                'str::first' => $this->firstName,
                'str::last' => $this->lastName,
                'str::name' => $this->name,
                'geo::city' => [
                    'name' => $this->city,
                ],
                'geo::country' => [
                    'name' => $this->country,
                ],
                'str::postal' => $this->postalCode,
                'dtz::b' => [
                    'year' => $this->birthdate?->year,
                    'month' => $this->birthdate?->month,
                    'day' => $this->birthdate?->day,
                    'timezone' => $this->birthdate?->getTimezone()->getName(),
                ],
                'bol::p' => $this->emailPermission,
                'bol::sp' => $this->smsPermission,
            ]
        ];
    }

    public function newCollection(array $items = []): Collection
    {
        return new Collection($items);
    }
}
```

Now for the factory. Laravel's `Illuminate\Database\Eloquent\Factories\Factory` class is built for Eloquent models, but it's generic enough to work with any class. We just need to extend it and tell it what to create:

```php
final class PersonFactory extends Factory
{
    protected $model = PersonData::class;

    private array $extraAttributes = [];

    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'email' => fake()->unique()->email(),
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'name' => fake()->name(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'postalCode' => fake()->postcode(),
            'birthdate' => CarbonImmutable::now(),
            'emailPermission' => fake()->boolean(),
            'smsPermission' => fake()->boolean(),
        ];
    }

    public function make($attributes = [], ?Model $parent = null): PersonData|Collection
    {
        $this->extraAttributes = $attributes;

        if ($this->count === null) {
            return $this->makeInstance($parent);
        }
        $instances = [];

        for ($i = 0; $i < $this->count; $i++) {
            $instances[] = $this->makeInstance($parent);
        }

        return collect($instances);
    }

    protected function makeInstance(?Model $parent = null): PersonData
    {
        $attributes = array_merge(
            $this->getRawAttributes($parent),
            $this->extraAttributes
        );

        return new PersonData(...$attributes);
    }

    public function newModel(array $attributes = []): PersonData
    {
        $attributes = array_merge($this->definition(), $attributes);

        return new PersonData(...$attributes);
    }
}
```

The `definition()` method returns the default attributes. Faker gives us realistic, random data every time.

But here's the crucial part: Laravel's factory expects Eloquent models, not Data Objects. We need to override `make()` to handle instantiation:

```php
public function make($attributes = [], ?Model $parent = null): PersonData|Collection
{
    $this->extraAttributes = $attributes;

    if ($this->count === null) {
        return $this->makeInstance($parent);
    }
    $instances = [];

    for ($i = 0; $i < $this->count; $i++) {
        $instances[] = $this->makeInstance($parent);
    }
    return collect($instances);
}
```

Instead of returning Eloquent models, this returns either a single `PersonData` or a `Collection` of them. The `makeInstance()` method handles the actual object creation:

```php
protected function makeInstance(?Model $parent = null): PersonData
{
    $attributes = array_merge(
        $this->getRawAttributes($parent),
        $this->extraAttributes
    );

    return new PersonData(...$attributes);
}
```

The `newModel()` method is simpler but still important:

```php
public function newModel(array $attributes = []): PersonData
{
    $attributes = array_merge($this->definition(), $attributes);
    return new PersonData(...$attributes);
}
```

Laravel's factory calls this internally when it needs to create a fresh instance. It merges your custom attributes with the defaults from `definition()`, then uses argument unpacking to instantiate the Data Object. Without this, the factory wouldn't know how to construct your non-Eloquent object.

Now we wire up the factory to the Data Object:

```php
class PersonData implements Arrayable
{
    // ... constructor and toArray() ...

    public static function factory(): PersonFactory
    {
        return PersonFactory::new();
    }

    public function newCollection(array $items = []): Collection
    {
        return collect($items);
    }
}
```

That's the setup. Now the magic happens in your tests.

## Testing Gets Stupid Simple

Here's a real test from the Ortto SDK. I need to verify that merging multiple people works correctly:

```php
it('can merge multiple people at once', function () {
    Ortto::fake();

    $people = PersonData::factory()->count(10)->make();

    $response = $this->ortto->send(
        new MergePopleRequest(
            people: $people->toArray(),
            mergeBy: ['str::email'],
            mergeStrategy: MergeStrategy::OverwriteExisting->value,
            finsStartegy: FindStrategy::All->value,
        )
    );

    expect($response->status())
        ->toBe(200)
        ->and($response->json())
        ->toHaveKey('people')
        ->and($response->json('people'))
        ->toBeArray()
        ->and($response->json('people'))
        ->toHaveCount(54);
});
```

Ten realistic people, with valid emails, names, cities, postal codes, and external IDs. All different. All random. One line.

Need edge cases? Override specific attributes:

```php
$person = PersonData::factory()->make([
    'email' => 'invalid-email',
    'postalCode' => '',
]);
```

Need a specific scenario? Make a factory state:

```php
public function withMissingCity(): static
{
    return $this->state(fn (array $attributes) => [
        'city' => null,
    ]);
}

// In your test
$person = PersonData::factory()->withMissingCity()->make();
```

Need sequences? Got it:

```php
$people = PersonData::factory()
    ->count(3)
    ->sequence(
        ['city' => 'Lisbon'],
        ['city' => 'Porto'],
        ['city' => 'Faro'],
    )
    ->make();
```

## The DRY Payoff

This pattern pays dividends immediately, but the real win shows up over time:

**One source of truth.** When the API changes (Ortto adds a required phone field, for example), you update the factory definition. Every test that uses `PersonData::factory()` instantly gets the new structure.

**Readable tests.** Compare these two:

```php
// Before: What are we even testing here?
$payload = [
    'people' => [
        ['fields' => ['str::email' => 'test@example.com', 'str::first' => 'Test', ...]],
        ['fields' => ['str::email' => 'test2@example.com', 'str::first' => 'Test2', ...]],
    ]
];

// After: Ah, we're testing bulk merges
$people = PersonData::factory()->count(50)->make();
```

**Reusable across tests.** Every test that needs person data uses the same factory. Integration tests, unit tests, feature tests. They all share the same realistic data generation.

**Type safety bonus.** Because we're working with Data Objects instead of arrays, our IDE catches mistakes before the tests run. Try to set `$person->emial` and your IDE screams at you. Try to set `$array['emial']` and you won't know until the test fails.

## The toArray() Bridge

The `toArray()` method is where we translate between our nice, typed PHP objects and whatever format the API expects. For Ortto, that means their type-prefixed notation (`str::`, `geo::`, `dtz::`, `bol::`), nested structures for geographic data, and complex datetime handling:

```php
public function toArray(): array
{
    return [
        'fields' => [
            'str::ei' => (string) $this->id,
            'str::email' => $this->email,
            'str::first' => $this->firstName,
            'str::last' => $this->lastName,
            'geo::city' => [
                'name' => $this->city,
            ],
            'geo::country' => [
                'name' => $this->country,
            ],
            'str::postal' => $this->postalCode,
            'dtz::b' => [
                'year' => $this->birthdate?->year,
                'month' => $this->birthdate?->month,
                'day' => $this->birthdate?->day,
                'timezone' => $this->birthdate?->getTimezone()->getName(),
            ],
            'bol::p' => $this->emailPermission,
            'bol::sp' => $this->smsPermission,
        ]
    ];
}
```

Look at that birthdate transformation. The API wants year, month, day, and timezone as separate fields. Without the Data Object, you'd be manually destructuring `CarbonImmutable` objects in every test. With it? One transformation, defined once, used everywhere.

Your API probably expects something different. Maybe flat arrays, maybe different nesting, maybe camelCase instead of snake_case. Doesn't matter. You control the transformation in one place, and every factory-generated object transforms consistently.

When working with collections, Laravel's `map` method makes the transformation trivial:

```php
$people = PersonData::factory()->count(54)->make();
$arrayOfArrays = $people->toArray();
```

That's calling `toArray()` on each `PersonData` object in the collection, then converting the collection itself to a plain PHP array. One line handles the entire transformation.

## What's Next

This pattern removes so much friction from testing that I kept finding ways to extend it. In the next article, we'll extract a `DataFactory` trait to clean up the repetitive factory setup even further. Then we'll tackle something trickier: managing relationships between Data Objects using factories.

The Laravel Ortto SDK uses this pattern throughout its test suite. Check out the complete implementations:
* [PersonData](https://github.com/phpdevkits/ortto-sdk/blob/main/src/Data/PersonData.php) - The Data Object with Arrayable interface
* [PersonFactory](https://github.com/phpdevkits/ortto-sdk/blob/main/tests/Factories/PersonFactory.php) - The factory with attribute mapping
* [MergePeopleTest](https://github.com/phpdevkits/ortto-sdk/blob/main/tests/Unit/Person/MergePeopleTest.php) - Real tests using the factory pattern

Stop writing arrays. Start using factories.
