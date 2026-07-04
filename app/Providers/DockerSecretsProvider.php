<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DockerSecretsProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach ($_ENV as $key => $value) {
            if (str_ends_with($key, '_FILE') && file_exists($value)) {
                $realKey = str_replace('_FILE', '', $key);
                $secret = trim(file_get_contents($value));
                config([
                    strtolower(str_replace('_', '.', $realKey)) => $secret
                ]);
                putenv("$realKey=$secret");
            }
        }
    }
}