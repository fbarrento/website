<?php

declare(strict_types=1);

use App\Actions\SubscribeNewsletter;
use App\Enums\LivewireEvents;
use App\Rules\UnauthorizedEmailDomains;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public string $email = '';

    public string $honeypot = '';

    public bool $subscribed = false;

    private SubscribeNewsletter $subscribeNewsletter;

    public function boot(SubscribeNewsletter $subscribeNewsletter): void
    {
        $this->subscribeNewsletter = $subscribeNewsletter;
    }

    public function mount(): void
    {
        $this->subscribed = Session::get('newsletter_subscribed', false);
    }

    #[NoReturn]
    public function subscribe(): void
    {

        $key = 'newsletter-'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('email', "Too many subscription attempts. Please try again in {$seconds} seconds.");

            return;
        }

        RateLimiter::hit($key, 60);

        if (! empty($this->honeypot)) {
            return;
        }

        $this->validate();
        $this->subscribeNewsletter->handle($this->email);
        $this->subscribed = true;

        Session::put('newsletter_subscribed', true);

        $this->dispatch(LivewireEvents::NewsletterSubscribed->value, [
            'email' => $this->email,
            'source' => request()->path(),
            'track' => app()->environment('production'),
        ]);

        $this->reset();

    }

    /**
     * @return array<string, mixed>
     */
    #[Validate]
    protected function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', new UnauthorizedEmailDomains],
        ];
    }
};
