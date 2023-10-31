<?php

namespace Heloufir\FilamentKanban;

use Heloufir\FilamentKeycloakSso\Livewire\Login;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentKanbanProvider extends PackageServiceProvider
{
    public static string $name = 'filament-kanban';

    public function configurePackage(Package $package): void
    {
        // Package name
        $package->name(static::$name);

        // Package translations
        $package->hasTranslations();

        // Package configuration file
        $package->hasConfigFile('filament-kanban');

    }
}
