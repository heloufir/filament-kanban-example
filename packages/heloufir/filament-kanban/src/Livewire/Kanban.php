<?php

namespace Heloufir\FilamentKanban\Livewire;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\ItemNotFoundException;
use Livewire\Attributes\On;

class Kanban extends Page implements HasForms
{
    use InteractsWithForms;

    /**
     * Filament page view
     * @var string
     */
    protected static string $view = 'filament-kanban::livewire.kanban';

    /**
     * Enable or disable handling record click by opening a modal
     * @var bool
     */
    protected static bool $handleRecordClickWithModal = false;

    /**
     * Enable or disable create a new record action
     * @var bool
     */
    protected static bool $enableCreateAction = false;

    /**
     * Statuses list
     * @var array
     */
    public array $statuses = [];

    /**
     * Records list
     * @var array
     */
    public array $records = [];

    /**
     * Resources list
     * @var array
     */
    public array $resources = [];

    /**
     * Selected record after click action
     * @var array
     */
    public array $record = [];

    /**
     * Filters data
     * @var array
     */
    public array $filters = [];

    /**
     * Modal mode, can be 'update' or 'create'
     * @var string
     */
    public string $modalMode;

    /**
     * Get records based on a status id
     * @param int $status
     * @return array
     * @author https://github.com/heloufir
     */
    protected function recordsByStatus(int $status): array
    {
        $results = array_filter($this->records, fn($item) => $item['status'] === $status);
        usort($results, function ($a, $b) {
            return $a['sort'] - $b['sort'];
        });
        return $results;
    }

    /**
     * Get record by ID
     * @param int $id
     * @return array|null
     * @author https://github.com/heloufir
     */
    protected function recordIndexById(int $id): ?int
    {
        return array_search($id, array_column($this->records, 'id')) ?? null;
    }

    /**
     * Reorder records inside based on status
     * @param int $status
     * @param array $newOrder
     * @return array
     * @author https://github.com/heloufir
     */
    protected function reorderRecords(int $status, array $newOrder): array
    {
        $reorderedRecords = [];
        $statusRecords = $this->recordsByStatus($status);
        for ($i = 0; $i < sizeof($statusRecords); $i++) {
            $recordIndex = $this->recordIndexById($statusRecords[$i]['id']);
            $oldSort = $this->records[$recordIndex]['sort'];
            $newSort = array_search($this->records[$recordIndex]['id'], $newOrder);
            $this->records[$recordIndex]['sort'] = $newSort;
            if ($oldSort !== $newSort) {
                $reorderedRecords[] = ['record' => $this->records[$recordIndex]['id'], 'old_index' => $oldSort, 'new_index' => $newSort];
            }
        }
        return $reorderedRecords;
    }

    /**
     * Check if the progress can be shown
     * @return bool|array
     * @author https://github.com/heloufir
     */
    protected function showProgress(): bool|array
    {
        return true;
    }

    /**
     * Get page actions
     * @return array|Action[]|\Filament\Actions\ActionGroup[]
     * @author https://github.com/heloufir
     */
    protected function getActions(): array
    {
        $actions = [];
        if (static::$enableCreateAction) {
            $actions[] = $this->createAction();
        }
        return $actions;
    }

    /**
     * Construct create action
     * @return Action
     * @author https://github.com/heloufir
     */
    protected function createAction(): Action
    {
        return Action::make('create')
            ->label(__('filament-kanban::filament-kanban.modal.create'))
            ->action(fn() => $this->handleCreateAction());
    }

    /**
     * Called when create action is called
     * @return void
     * @author https://github.com/heloufir
     */
    protected function handleCreateAction(): void
    {
        $this->modalMode = 'create';
        $this->record = [
            'id' => null,
            'status' => null,
            'title' => null,
            'subtitle' => null,
            'sort' => 0,
            'draggable' => true,
            'click' => true,
            'progress' => 0,
            'owner' => null,
            'assignees' => [],
            'tags' => null
        ];
        $this->dispatch('open-modal', id: 'filament-kanban.record-modal');
    }

    /**
     * Handle record modal submit action
     * @return void
     * @author https://github.com/heloufir
     */
    public function submitRecord(): void
    {
        //
    }

    /**
     * Handle record dragged javascript event
     * @param int $record
     * @param int $source
     * @param int $target
     * @param int $oldIndex
     * @param int $newIndex
     * @param array $newOrder
     * @return void
     * @author https://github.com/heloufir
     */
    #[On('filament-kanban.record-drag')]
    public function recordDrag(int $record, int $source, int $target, int $oldIndex, int $newIndex, array $newOrder)
    {
        $index = $this->recordIndexById($record);
        if ($this->records[$index] ?? null) {
            $this->records[$index]['status'] = $target;
            $this->records[$index]['sort'] = $newIndex;
            $reorderedRecords = $this->reorderRecords($target, $newOrder);
            $this->dispatch('filament-kanban.record-dragged', [
                'record' => $record,
                'source' => $source,
                'target' => $target,
                'old_index' => $oldIndex,
                'new_index' => $newIndex,
                'ordered_records' => $reorderedRecords
            ]);
        }
    }

    /**
     * Handle record sorted javascript event
     * @param int $record
     * @param int $source
     * @param int $target
     * @param int $oldIndex
     * @param int $newIndex
     * @param array $newOrder
     * @return void
     * @author https://github.com/heloufir
     */
    #[On('filament-kanban.record-sort')]
    public function recordSort(int $record, int $source, int $target, int $oldIndex, int $newIndex, array $newOrder)
    {
        $index = $this->recordIndexById($record);
        if ($this->records[$index] ?? null) {
            $this->records[$index]['sort'] = $newIndex;
            $reorderedRecords = $this->reorderRecords($target, $newOrder);
            $this->dispatch('filament-kanban.record-sorted', [
                'record' => $record,
                'source' => $source,
                'target' => $target,
                'old_index' => $oldIndex,
                'new_index' => $newIndex,
                'ordered_records' => $reorderedRecords
            ]);
        }
    }

    /**
     * Handle record click event
     * @param int $record
     * @return void
     * @author https://github.com/heloufir
     */
    public function recordClick(int $record): void
    {
        $index = $this->recordIndexById($record);
        if (static::$handleRecordClickWithModal) {
            $this->modalMode = 'update';
            $this->record = $this->records[$index];
            $this->record['tags'] = isset($this->record['tags']) ? implode(',', $this->record['tags']) : null;
            $this->dispatch('open-modal', id: 'filament-kanban.record-modal');
        } else {
            if ($this->records[$index]['click'] ?? true) {
                $this->dispatch('filament-kanban.record-clicked', [
                    'record' => $record
                ]);
            }
        }
    }

    /**
     * Defining Forms
     * @return string[]
     * @author https://github.com/heloufir
     */
    protected function getForms(): array
    {
        return [
            'form', // Modal form
            'filterForm' // Filter form
        ];
    }

    /**
     * Defining record dialog form
     * @param Form $form
     * @return Form
     * @author https://github.com/heloufir
     */
    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(4)
                ->schema([
                    Select::make('record.owner')
                        ->visible(fn() => !collect($this->resources)->isEmpty())
                        ->label(__('filament-kanban::filament-kanban.modal.form.owner'))
                        ->options(fn() => collect($this->resources)->pluck('name', 'id')->toArray()),

                    DatePicker::make('record.deadline')
                        ->label(__('filament-kanban::filament-kanban.modal.form.deadline')),

                    TextInput::make('record.title')
                        ->columnSpan(2)
                        ->label(__('filament-kanban::filament-kanban.modal.form.title'))
                        ->required(),
                ]),

            TextInput::make('record.subtitle')
                ->label(__('filament-kanban::filament-kanban.modal.form.subtitle'))
                ->required(),

            Grid::make(3)
                ->schema([
                    Select::make('record.status')
                        ->label(__('filament-kanban::filament-kanban.modal.form.status'))
                        ->options(fn() => collect($this->statuses)->pluck('name', 'id')->toArray())
                        ->columnSpan(2)
                        ->required(),

                    TextInput::make('record.progress')
                        ->label(__('filament-kanban::filament-kanban.modal.form.progress'))
                        ->numeric()
                        ->inputMode('decimal')
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(100)
                        ->live()
                        ->required(),
                ]),

            CheckboxList::make('record.assignees')
                ->visible(fn() => !collect($this->resources)->isEmpty())
                ->label(__('filament-kanban::filament-kanban.modal.form.assignees'))
                ->options(fn() => collect($this->resources)->pluck('name', 'id')->toArray()),

            TextInput::make('record.tags')
                ->label(__('filament-kanban::filament-kanban.modal.form.tags'))
                ->helperText(__('filament-kanban::filament-kanban.modal.form.tags-helper-text')),
        ]);
    }

    /**
     * Defining filter form
     * @param Form $form
     * @return Form
     * @author https://github.com/heloufir
     */
    public function filterForm(Form $form): Form
    {
        return $form->schema([
            Grid::make(3)
                ->schema([
                    DatePicker::make('filters.deadline')
                        ->label(__('filament-kanban::filament-kanban.modal.form.deadline')),

                    TextInput::make('filters.title')
                        ->label(__('filament-kanban::filament-kanban.modal.form.title')),

                    TextInput::make('filters.subtitle')
                        ->label(__('filament-kanban::filament-kanban.modal.form.subtitle')),
                ]),

            Grid::make(3)
                ->schema([
                    Select::make('filters.owner')
                        ->label(__('filament-kanban::filament-kanban.modal.form.owner'))
                        ->options(fn() => collect($this->resources)->pluck('name', 'id')->toArray()),

                    Select::make('filters.assignees')
                        ->label(__('filament-kanban::filament-kanban.modal.form.assignees'))
                        ->options(fn() => collect($this->resources)->pluck('name', 'id')->toArray()),

                    TextInput::make('filters.tags')
                        ->label(__('filament-kanban::filament-kanban.modal.form.tags'))
                        ->helperText(__('filament-kanban::filament-kanban.modal.form.tags-helper-text')),
                ])
        ]);
    }

    /**
     * Get resource avatar based on it's id
     * @param int $resource
     * @return string|null
     * @author https://github.com/heloufir
     */
    public function getResourceAvatar(int $resource): string|null
    {
        try {
            $resource = collect($this->resources)->where('id', $resource)->firstOrFail();
            return $resource['avatar'] ?? $this->generateAvatar($resource['name']);
        } catch (ItemNotFoundException $e) {
            return null;
        }
    }

    /**
     * Get resource name based on it's id
     * @param int $resource
     * @return string|null
     * @author https://github.com/heloufir
     */
    public function getResourceName(int $resource): string|null
    {
        try {
            $resource = collect($this->resources)->where('id', $resource)->firstOrFail();
            return $resource['name'];
        } catch (ItemNotFoundException $e) {
            return null;
        }
    }

    /**
     * Get resource name based on it's id
     * @param string $name
     * @return string
     * @author https://github.com/heloufir
     */
    protected function generateAvatar(string $name): string
    {
        return 'https://ui-avatars.com/api/?background=b5d0eb&size=200&name=' . $name;
    }

    /**
     * @param array $statuses
     * @return void
     * @author https://github.com/heloufir
     */
    public function setStatuses(array $statuses): void
    {
        $this->statuses = $statuses;
    }

    /**
     * @param array $records
     * @return void
     * @author https://github.com/heloufir
     */
    public function setRecords(array $records): void
    {
        $this->records = $records;
    }

    /**
     * @param array $resources
     * @return void
     * @author https://github.com/heloufir
     */
    public function setResources(array $resources): void
    {
        $this->resources = $resources;
    }

    /**
     * Create a carbon date based on deadline string date
     * @param string $dateString
     * @return Carbon
     * @author https://github.com/heloufir
     */
    public function deadlineDate(string $dateString): Carbon|null
    {
        try {
            return Carbon::createFromFormat('Y-m-d', $dateString);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Format deadline date
     * @param string $date
     * @return string
     * @author https://github.com/heloufir
     */
    public function formatDeadline(string $dateString): string|null
    {
        $date = $this->deadlineDate($dateString);
        if ($date) {
            return $date->format(config('filament-kanban.deadline-format'));
        }
        return null;
    }

    /**
     * Get the deadline date color based on the difference in days with current date
     * @param string $dateString
     * @return string
     * @author https://github.com/heloufir
     */
    protected function deadlineColor(string $dateString): string
    {
        $date = $this->deadlineDate($dateString);
        if (!$date) {
            return '';
        }
        $today = Carbon::today();
        if ($date->lt($today)) {
            return 'bg-gray-700';
        }
        $differenceInDays = $today->diffInDays($date);
        if ($differenceInDays > 10) {
            return 'bg-gray-700';
        } elseif ($differenceInDays >= 5) {
            // Between 5 and 10 days (in the future)
            return 'bg-orange-700';
        } else {
            // Less than 5 days (in the future)
            return 'bg-red-700';
        }
    }

    /**
     * Filter records based on the form
     * @return void
     * @author https://github.com/heloufir
     */
    public function submitFilter(): void
    {
        $data = $this->filterForm->getState()['filters'];
        $this->dispatch('filament-kanban.filter', $data);
    }

    /**
     * Reset filter forms
     * @return void
     * @author https://github.com/heloufir
     */
    public function doResetFilter(): void
    {
        $this->filters = [];
        $this->filterForm->fill();
        $this->dispatch('filament-kanban.reset-filter');
    }
}
