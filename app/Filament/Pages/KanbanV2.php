<?php

namespace App\Filament\Pages;

use App\Models\Record;
use App\Models\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

    function recordForm(): array
    {
        return [
            Grid::make()
                ->schema([
                    Select::make('status_id')
                        ->searchable()
                        ->preload()
                        ->relationship('status', 'title')
                        ->required(),
                ]),

            TextInput::make('title')
                ->columnSpanFull()
                ->maxLength(255)
                ->required(),

            Grid::make(3)
                ->schema([
                    Select::make('owner_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('owner', 'name')
                        ->default(fn() => auth()->id()),

                    Select::make('assignees')
                        ->searchable()
                        ->columnSpan(2)
                        ->preload()
                        ->relationship('assignees', 'name')
                        ->multiple(),
                ]),

            RichEditor::make('description')
                ->columnSpanFull(),

            Grid::make()
                ->schema([
                    DatePicker::make('deadline'),

                    TextInput::make('progress')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100),
                ]),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->addAction()
        ];
    }
}
