<?php

namespace Heloufir\FilamentKanban\enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum KanbanView: string implements HasLabel, HasIcon
{

    case BOARD = 'board';

    case LIST = 'list';

    public function getLabel(): ?string
    {
        return __('filament-kanban::filament-kanban.views.' . $this->value);
    }

    public function getIcon(): ?string
    {
        return config('filament-kanban.views.icons.' . $this->value);
    }

    public function getIconPosition(): string
    {
        return config('filament-kanban.views.icons.position');
    }
}
