<?php

namespace Heloufir\FilamentKanban;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Heloufir\FilamentKanban\Livewire\Kanban;

class FilamentKanbanPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-kanban';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Kanban::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
