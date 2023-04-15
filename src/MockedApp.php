<?php

namespace blink\laravel\database;

use blink\core\NotSupportedException;
use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;

class MockedApp extends Container implements Application
{
    public function version()
    {
        throw new NotSupportedException("should not be called");
    }

    public function basePath($path = '')
    {
        throw new NotSupportedException("should not be called");
    }

    public function bootstrapPath($path = '')
    {
        throw new NotSupportedException("should not be called");
    }

    public function configPath($path = '')
    {
        throw new NotSupportedException("should not be called");
    }

    public function databasePath($path = '')
    {
        throw new NotSupportedException("should not be called");
    }

    public function resourcePath($path = '')
    {
        throw new NotSupportedException("should not be called");
    }

    public function storagePath()
    {
        throw new NotSupportedException("should not be called");
    }

    public function environment(...$environments)
    {
        throw new NotSupportedException("should not be called");
    }

    public function runningInConsole()
    {
        throw new NotSupportedException("should not be called");
    }

    public function runningUnitTests()
    {
        throw new NotSupportedException("should not be called");
    }

    public function isDownForMaintenance()
    {
        throw new NotSupportedException("should not be called");
    }

    public function registerConfiguredProviders()
    {
        throw new NotSupportedException("should not be called");
    }

    public function register($provider, $force = false)
    {
        throw new NotSupportedException("should not be called");
    }

    public function registerDeferredProvider($provider, $service = null)
    {
        throw new NotSupportedException("should not be called");
    }

    public function resolveProvider($provider)
    {
        throw new NotSupportedException("should not be called");
    }

    public function boot()
    {
        throw new NotSupportedException("should not be called");
    }

    public function booting($callback)
    {
        throw new NotSupportedException("should not be called");
    }

    public function booted($callback)
    {
        throw new NotSupportedException("should not be called");
    }

    public function bootstrapWith(array $bootstrappers)
    {
        throw new NotSupportedException("should not be called");
    }

    public function getLocale()
    {
        throw new NotSupportedException("should not be called");
    }

    public function getNamespace()
    {
        throw new NotSupportedException("should not be called");
    }

    public function getProviders($provider)
    {
        throw new NotSupportedException("should not be called");
    }

    public function hasBeenBootstrapped()
    {
        throw new NotSupportedException("should not be called");
    }

    public function loadDeferredProviders()
    {
        throw new NotSupportedException("should not be called");
    }

    public function setLocale($locale)
    {
        throw new NotSupportedException("should not be called");
    }

    public function shouldSkipMiddleware()
    {
        throw new NotSupportedException("should not be called");
    }

    public function terminate()
    {
        throw new NotSupportedException("should not be called");
    }
}
