<?php

declare(strict_types=1);

use App\Actions\SubscribeNewsletter;
use App\Rules\UnauthorizedEmailDomains;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public string $email = '';

    public bool $subscribed = false;

    private SubscribeNewsletter $subscribeNewsletter;

    public function boot(SubscribeNewsletter $subscribeNewsletter): void
    {
        $this->subscribeNewsletter = $subscribeNewsletter;
    }

    #[NoReturn]
    public function subscribe(): void
    {
        $this->validate();
        $this->subscribeNewsletter->handle($this->email);
        $this->reset();
    }

    /**
     * @return array<string, mixed>
     */
    #[Validate]
    protected function rules(): array
    {
        return [
            'email' => ['required', 'email', new UnauthorizedEmailDomains],
        ];
    }
};
