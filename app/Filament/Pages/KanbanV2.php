<?php

namespace App\Filament\Pages;

use App\Models\Record;
use App\Models\Status;
use Heloufir\FilamentKanban\Filament\KanbanBoard;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatuses;
use Illuminate\Database\Eloquent\Builder;

class KanbanV2 extends KanbanBoard
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $slug = 'v2/board';

    protected static ?string $navigationGroup = 'Version 2';

    function getStatuses(): KanbanStatuses
    {
        return KanbanStatuses::make(
            Status::all()
                ->map(fn(Status $item) => $item->toStatus())
        );
    }

    function model(): string
    {
        return Record::class;
    }

    function query(Builder $query): Builder
    {
        return $query;
    }
}
