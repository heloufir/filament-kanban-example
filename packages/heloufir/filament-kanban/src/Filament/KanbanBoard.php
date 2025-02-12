<?php

namespace Heloufir\FilamentKanban\Filament;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Pages\Page;
use Filament\Support\Enums\ActionSize;
use Heloufir\FilamentKanban\ValueObjects\KanbanRecords;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

abstract class KanbanBoard extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string $view = 'filament-kanban::pages.kanban-board';

    public int $perPage;

    public function mount(): void
    {
        $this->perPage = $this->getModel()->getPerPage();
    }

    abstract function recordInfolist(): array;

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
            $this->getQuery()
                ->orderBy($this->getModel()->sortColumn())
                ->get()
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
            ->visible(fn ($record) => $record->toRecord()->isEditable())
            ->size(ActionSize::ExtraSmall)
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm());
    }

    protected function viewAction(): Action
    {
        return ViewAction::make()
            ->record(fn(array $arguments) => $this->getQuery()->find($arguments['record']))
            ->visible(fn ($record) => $record->toRecord()->isViewable())
            ->size(ActionSize::ExtraSmall)
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->infolist(fn () => $this->recordInfolist());
    }

    protected function addAction(): Action
    {
        return CreateAction::make()
            ->model(fn() => $this->model())
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm())
            ->mutateFormDataUsing(function (array $data) {
                $statusColumn = $this->getModel()->statusColumn();
                $sortColumn = $this->getModel()->sortColumn();
                $data[$sortColumn] = $this->getQuery()->where($statusColumn, $data[$statusColumn])->max($sortColumn) + 1;
                return $data;
            });
    }

    protected function deleteAction(): Action
    {
        return DeleteAction::make()
            ->record(fn(array $arguments) => $this->getQuery()->find($arguments['record']))
            ->visible(fn ($record) => $record->toRecord()->isDeletable())
            ->size(ActionSize::ExtraSmall);
    }

    #[On('kanban.drag')]
    public function onDragEnd(int $id, int $statusFrom, int $statusTo, int $oldSort, int $newSort)
    {
        DB::transaction(function () use ($id, $statusFrom, $statusTo, $oldSort, $newSort) {
            $statusColumn = $this->getModel()->statusColumn();
            $sortColumn = $this->getModel()->sortColumn();

            $record = $this->getModel()->find($id);

            if (!$record) {
                return;
            }

            if ($statusFrom === $statusTo) {
                if ($oldSort < $newSort) {
                    $this->getModel()->where($statusColumn, $statusTo)
                        ->where($sortColumn, '>', $oldSort)
                        ->where($sortColumn, '<=', $newSort)
                        ->decrement($sortColumn);
                } else {
                    $this->getModel()->where($statusColumn, $statusTo)
                        ->where($sortColumn, '>=', $newSort)
                        ->where($sortColumn, '<', $oldSort)
                        ->increment($sortColumn);
                }
            } else {
                $this->getModel()->where($statusColumn, $statusFrom)
                    ->where($sortColumn, '>', $oldSort)
                    ->decrement($sortColumn);

                $this->getModel()->where($statusColumn, $statusTo)
                    ->where($sortColumn, '>=', $newSort)
                    ->increment($sortColumn);

                $record->{$statusColumn} = $statusTo;
            }

            $record->{$sortColumn} = $newSort;
            $record->save();
        });
    }


}
