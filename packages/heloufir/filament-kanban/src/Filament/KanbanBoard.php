<?php

namespace Heloufir\FilamentKanban\Filament;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Pages\Page;
use Filament\Support\Enums\ActionSize;
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

    abstract function recordForm(): array;

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
            $this->getQuery()->get()
        );
    }

    protected function getColumnWidth(): string
    {
        return '350px';
    }

    protected function editAction(): Action
    {
        return EditAction::make()
            ->record(fn(array $arguments) => $this->getQuery()->find($arguments['record']))
            ->size(ActionSize::ExtraSmall)
            ->label(__('filament-kanban::filament-kanban.actions.edit'))
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm());
    }

    protected function addAction(): Action
    {
        return CreateAction::make()
            ->model(fn() => $this->model())
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm());
    }

    protected function deleteAction(): Action
    {
        return DeleteAction::make()
            ->record(fn(array $arguments) => $this->getQuery()->find($arguments['record']))
            ->size(ActionSize::ExtraSmall)
            ->label(__('filament-kanban::filament-kanban.actions.delete'));
    }

}
