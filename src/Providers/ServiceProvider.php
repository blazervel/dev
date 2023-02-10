<?php declare (strict_types=1);

namespace Blazervel\Dev\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        //
    }

    public static function path(string ...$path): string
    {
        return implode('/', [
            Str::remove('src/Providers', __DIR__),
            ...$path,
        ]);
    }
}
