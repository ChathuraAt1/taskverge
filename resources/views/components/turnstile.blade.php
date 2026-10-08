@props(['action' => 'verification'])

<div {{ $attributes->class(['cf-turnstile']) }}
     data-sitekey="{{ config('services.turnstile.key') }}"
     data-action="{{ $action }}"
     data-theme="dark"></div>

@error('cf-turnstile-response')
    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
@enderror

@once
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endonce
