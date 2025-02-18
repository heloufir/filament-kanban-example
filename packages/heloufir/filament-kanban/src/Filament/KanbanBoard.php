<?php

namespace Heloufir\FilamentKanban\Filament;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Heloufir\FilamentKanban\enums\KanbanView;
use Heloufir\FilamentKanban\ValueObjects\KanbanRecords;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Filament\Tables\Actions as TableActions;

abstract class KanbanBoard extends Page implements HasActions, HasTable
{
    use InteractsWithTable;
    use InteractsWithActions;

    /**
     * @var string The view that will be rendered.
     */
    protected static string $view = 'filament-kanban::pages.kanban-board';

    /**
     * @var KanbanView The current view.
     */
    protected KanbanView $currentView = KanbanView::BOARD;

    /**
     * @var array The views that will be visible in Kanban page.
     */
    protected array $enabledViews = [
        KanbanView::BOARD,
        KanbanView::LIST,
        KanbanView::TABLE,
    ];

    /**
     * @var bool Whether the view tabs should be shown or not.
     */
    protected bool $showViewTabs = false;

    /**
     * @var bool Whether the current tab should be persisted on Cookies or not.
     */
    protected bool $persistCurrentTab = false;

    /**
     * @var bool Whether the statuses should be shown as tabs or not. (works only in List view)
     */
    protected bool $showStatusesAsTabs = false;

    /**
     * Mounting the Kanban board.
     * @return void
     * @author https://github.com/heloufir
     */
    public function mount(): void
    {
        if ($this->persistCurrentTab) {
            $cookieValue = strtolower(Cookie::get('filament-kanban-view-' . Str::slug(self::getSlug())) ?? $this->currentView->name);
            $this->currentView = KanbanView::tryFrom($cookieValue);
        }
    }

    /**
     * Record Filament infolist schema.
     * @return array
     * @author https://github.com/heloufir
     */
    abstract function recordInfolist(): array;

    /**
     * Record Filament form schema.
     * @return array
     * @author https://github.com/heloufir
     */
    abstract function recordForm(): array;

    /**
     * Getting statuses for the Kanban board.
     * @return KanbanStatuses
     * @author https://github.com/heloufir
     */
    abstract function getStatuses(): KanbanStatuses;

    /**
     * Record model class.
     * @return string
     * @author https://github.com/heloufir
     */
    abstract function model(): string;

    /**
     * Query builder used for getting records.
     * @param Builder $query Query builder
     * @return Builder
     * @author https://github.com/heloufir
     */
    abstract function query(Builder $query): Builder;

    /**
     * Getting the record model object.
     * @return Model
     * @author https://github.com/heloufir
     */
    protected function getModel(): Model
    {
        return new ($this->model());
    }

    /**
     * Getting the query builder for record model object.
     * @return Builder
     * @author https://github.com/heloufir
     */
    protected function getQuery(): Builder
    {
        return $this->query($this->getModel()->newQuery());
    }

    /**
     * Getting the records list
     * @return KanbanRecords
     * @author https://github.com/heloufir
     */
    protected function getRecords(): KanbanRecords
    {
        return KanbanRecords::make(
            $this->getQuery()
                ->orderBy($this->getModel()->sortColumn())
                ->get()
        );
    }

    /**
     * Kanban board column width.
     * @return string
     * @author https://github.com/heloufir
     */
    protected function getColumnWidth(): string
    {
        return '350px';
    }

    /**
     * Record Filament edit action.
     * @return Action
     * @author https://github.com/heloufir
     */
    protected function editAction(): Action
    {
        return EditAction::make()
            ->record(fn(array $arguments) => $this->getQuery()->find($arguments['record'][$this->getModel()->getKeyName()]))
            ->size(ActionSize::ExtraSmall)
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm());
    }

    /**
     * Record Table Filament edit action.
     * @return TableActions\Action
     * @author https://github.com/heloufir
     */
    protected function editTableAction(): TableActions\Action
    {
        return TableActions\EditAction::make()
            ->size(ActionSize::ExtraSmall)
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm());
    }

    /**
     * Record Filament view action.
     * @return Action
     * @author https://github.com/heloufir
     */
    protected function viewAction(): Action
    {
        return ViewAction::make()
            ->record(fn(array $arguments) => $this->getQuery()->find($arguments['record'][$this->getModel()->getKeyName()]))
            ->size(ActionSize::ExtraSmall)
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->infolist(fn() => $this->recordInfolist());
    }

    /**
     * Record Table Filament view action.
     * @return TableActions\Action
     * @author https://github.com/heloufir
     */
    protected function viewTableAction(): TableActions\Action
    {
        return TableActions\ViewAction::make()
            ->size(ActionSize::ExtraSmall)
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->infolist(fn() => $this->recordInfolist());
    }

    /**
     * Record Filament create action.
     * @return Action
     * @author https://github.com/heloufir
     */
    protected function addAction(): Action
    {
        return CreateAction::make()
            ->model(fn() => $this->model())
            ->slideOver(config('filament-kanban.record-modal.position') === 'slide-over')
            ->modalWidth(config('filament-kanban.record-modal.size'))
            ->form(fn() => $this->recordForm())
            ->mutateFormDataUsing(fn(array $data) => $this->mutateFormDataAfterAddAction($data));
    }

    /**
     * Mutate form data after adding a new record.
     * @param array $data
     * @return array
     * @author https://github.com/heloufir
     */
    protected function mutateFormDataAfterAddAction(array $data): array
    {
        $statusColumn = $this->getModel()->statusColumn();
        $sortColumn = $this->getModel()->sortColumn();
        $data[$sortColumn] = $this->getQuery()->where($statusColumn, $data[$statusColumn])->max($sortColumn) + 1;
        return $data;
    }

    /**
     * Record Filament delete action.
     * @return Action
     * @author https://github.com/heloufir
     */
    protected function deleteAction(): Action
    {
        return Action::make('delete')
            ->action(function (array $arguments) {
                $record = $this->getQuery()->find($arguments['record'][$this->getModel()->getKeyName()]);
                $record->delete();
                Notification::make('deleted')
                    ->success()
                    ->title(__('filament-kanban::filament-kanban.actions.deleted'))
                    ->send();
            })
            ->label(__('filament-actions::delete.single.label'))
            ->modalHeading(fn(array $arguments): string => __('filament-actions::delete.single.modal.heading', ['label' => $arguments['recordTitle']]))
            ->modalSubmitActionLabel(__('filament-actions::delete.single.modal.actions.delete.label'))
            ->successNotificationTitle(__('filament-actions::delete.single.notifications.deleted.title'))
            ->color('danger')
            ->groupedIcon(FilamentIcon::resolve('actions::delete-action.grouped') ?? 'heroicon-m-trash')
            ->requiresConfirmation()
            ->modalIcon(FilamentIcon::resolve('actions::delete-action.modal') ?? 'heroicon-o-trash')
            ->keyBindings(['mod+d'])
            ->size(ActionSize::ExtraSmall);
    }

    /**
     * Record Table Filament delete action.
     * @return TableActions\Action
     * @author https://github.com/heloufir
     */
    protected function deleteTableAction(): TableActions\Action
    {
        return TableActions\DeleteAction::make();
    }

    /**
     * Event listener for dragging and sorting records.
     * @param string|int $id Record ID
     * @param int $statusFrom Status ID from which the record is dragged/sorted
     * @param int $statusTo Status ID to which the record is dragged/sorted
     * @param int $oldSort Old sort value
     * @param int $newSort New sort value
     * @return void
     * @author https://github.com/heloufir
     */
    #[On('kanban.drag')]
    public function onDragEnd(string|int $id, string|int $statusFrom, string|int $statusTo, int $oldSort, int $newSort)
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

    /**
     * Table definition
     * @param Table $table
     * @return Table
     * @author https://github.com/heloufir
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(fn() => $this->getQuery())
            ->columns($this->tableColumns())
            ->filters($this->filters(), $this->tableFiltersLayout())
            ->actions($this->tableActions())
            ->bulkActions($this->tableBulkActions())
            ->persistFiltersInSession($this->tableShouldPersistFilters());
    }

    /**
     * Table columns definition
     * @return array
     * @author https://github.com/heloufir
     */
    protected function tableColumns(): array
    {
        return [];
    }

    /**
     * Table filters definition
     * @return array
     * @author https://github.com/heloufir
     */
    protected function filters(): array
    {
        return [];
    }

    /**
     * Table actions definition
     * @return array
     * @author https://github.com/heloufir
     */
    protected function tableActions(): array
    {
        return [];
    }

    /**
     * Table filters layout definition
     * @return FiltersLayout
     * @author https://github.com/heloufir
     */
    protected function tableFiltersLayout(): FiltersLayout
    {
        return FiltersLayout::Dropdown;
    }

    /**
     * Table should persist filters in session
     * @return bool
     * @author https://github.com/heloufir
     */
    protected function tableShouldPersistFilters(): bool
    {
        return false;
    }

    /**
     * Table bulk actions definition
     * @return array
     * @author https://github.com/heloufir
     */
    protected function tableBulkActions(): array
    {
        return [];
    }

    /**
     * Event listener for changing the current Kanban view.
     * @param string $active The active view
     * @return void
     * @author https://github.com/heloufir
     */
    #[On('kanban.change-view')]
    public function onChangeView(string $active)
    {
        if ($this->persistCurrentTab) {
            Cookie::queue(Cookie::make('filament-kanban-view-' . Str::slug(self::getSlug()), $active, 60 * 24 * 365));
        }
    }


}
