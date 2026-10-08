<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class Turnstile
{
    public function verify(?string $token, string $action): void
    {
        if (! $token || ! config('services.turnstile.secret')) {
            throw ValidationException::withMessages([
                'cf-turnstile-response' => 'Please complete the security check and try again.',
            ]);
        }

        try {
            $response = Http::timeout(5)->asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => config('services.turnstile.secret'),
                'response' => $token,
                'remoteip' => request()->ip(),
            ]);
        } catch (\Throwable) {
            $response = null;
        }

        if (! $response?->successful() ||
            $response->json('success') !== true ||
            $response->json('action') !== $action ||
            $response->json('hostname') !== request()->getHost()) {
            throw ValidationException::withMessages([
                'cf-turnstile-response' => 'The security check could not be verified. Please try again.',
            ]);
        }
    }
}
