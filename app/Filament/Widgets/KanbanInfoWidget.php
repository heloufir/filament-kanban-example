<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class KanbanInfoWidget extends Widget
{

    protected static ?int $sort = 1;

    protected static string $view = 'widgets.kanban-info-widget';

    protected int | string | array $columnSpan = 'full';

}
