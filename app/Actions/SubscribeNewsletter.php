<?php

declare(strict_types=1);

namespace App\Actions;

use App\Services\Brevo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Client\ConnectionException;

final readonly class SubscribeNewsletter implements ShouldQueue
{
    public function __construct(private Brevo $brevo) {}

    /**
     * @throws ConnectionException
     */
    public function handle(string $email): void
    {

        $this->brevo->CreateContact($email);
        info('Newsletter subscribed');

    }
}
