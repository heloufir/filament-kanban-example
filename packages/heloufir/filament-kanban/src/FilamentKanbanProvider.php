<?php

namespace Heloufir\FilamentKanban;

use Filament\Support\Assets\Js;
use Filament\Support\Assets\Theme;
use Filament\Support\Facades\FilamentAsset;
use Heloufir\FilamentKanban\Livewire\Kanban;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentKanbanProvider extends PackageServiceProvider
{
    public static string $name = 'filament-kanban';

    public static string $viewNamespace = 'filament-kanban';

    public function configurePackage(Package $package): void
    {
        // Package name
        $package->name(static::$name);

        // Package views
        $package->hasViews(static::$viewNamespace);

        // Package translations
        $package->hasTranslations();

        // Package configuration file
        $package->hasConfigFile('filament-kanban');

        // Package assets
        $package->hasAssets();

        // Initialize Livewire components
        $this->initComponents();

    }

    private function initComponents(): void {
        Livewire::component('fk-kanban', Kanban::class);
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Theme::make('app', __DIR__ . '/../dist/filament-kanban.css'),
        ], 'heloufir/filament-kanban');
    }
}
