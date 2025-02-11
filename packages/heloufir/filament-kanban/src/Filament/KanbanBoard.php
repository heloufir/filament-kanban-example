<?php

namespace Heloufir\FilamentKanban\Filament;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Pages\Page;
use Heloufir\FilamentKanban\ValueObjects\KanbanRecords;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class KanbanBoard extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string $view = 'filament-kanban::pages.kanban-board';

    public int $perPage;

    public function mount(): void
    {
        $this->perPage = $this->getModel()->getPerPage();
    }

    abstract function getStatuses(): KanbanStatuses;

    abstract function model(): string;

    abstract function query(Builder $query): Builder;

    protected function getModel(): Model
    {
        return new ($this->model());
    }

    protected function getQuery(): Builder
    {
        return $this->query($this->getModel()->newQuery());
    }

    protected function getRecords(): KanbanRecords
    {
        return KanbanRecords::make(
            $this->getQuery()
                ->get()
                ->map(fn($item) => $item->toRecord())
        );
    }

    protected function getColumnWidth(): string
    {
        return '350px';
    }

}
