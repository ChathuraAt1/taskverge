<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$token = (string) config('app.cache_clear_token', '');
if ($token === '') {
    http_response_code(404);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!doctype html><html lang="en"><meta charset="utf-8"><title>Clear application cache</title>';
    echo '<form method="post"><label>Access token <input type="password" name="token" required autocomplete="current-password"></label> <button type="submit">Clear cache</button></form>';
    exit;
}

if (!hash_equals($token, (string) ($_POST['token'] ?? ''))) {
    http_response_code(404);
    exit;
}

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->call('optimize:clear');

header('Content-Type: text/plain; charset=UTF-8');
echo $kernel->output();

if ($status === 0) {
    unlink(__FILE__);
    echo "\nCache cleared. This script has removed itself.";
}
