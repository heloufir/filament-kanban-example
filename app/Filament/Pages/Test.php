<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Heloufir\FilamentKanban\Livewire\Kanban;

class Test extends Kanban
{
    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static bool $handleRecordClickWithModal = true;

    protected static ?string $title = 'Filament Kanban';

    protected $listeners = [
        'filament-kanban.record-dragged' => 'recordDragged',
        'filament-kanban.record-sorted' => 'recordSorted',
        'filament-kanban.record-clicked' => 'recordClicked',
    ];

    public array $statuses = [
        ['id' => 1, 'name' => 'Draft', 'color' => 'gray', 'draggable' => true],
        ['id' => 2, 'name' => 'Submitted', 'color' => 'blue', 'draggable' => false],
        ['id' => 3, 'name' => 'Changes requested', 'color' => 'orangered', 'draggable' => true],
        ['id' => 4, 'name' => 'Published', 'color' => 'green', 'draggable' => true],
    ];

    public array $records = [
        ['id' => 1, 'status' => 2, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 20],
        ['id' => 2, 'status' => 3, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 30],
        ['id' => 3, 'status' => 3, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true],
        ['id' => 4, 'status' => 3, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false],
        ['id' => 5, 'status' => 3, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true, 'progress' => 35],
        ['id' => 6, 'status' => 4, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 40],
        ['id' => 7, 'status' => 4, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true, 'progress' => 50],
        ['id' => 8, 'status' => 4, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true],
        ['id' => 9, 'status' => 4, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true, 'progress' => 100],
        ['id' => 10, 'status' => 4, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true, 'progress' => 80],
        ['id' => 11, 'status' => 4, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true, 'progress' => 75],
        ['id' => 12, 'status' => 4, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true, 'progress' => 90],
        ['id' => 13, 'status' => 4, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true, 'progress' => 85],
        ['id' => 14, 'status' => 4, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true],
        ['id' => 15, 'status' => 4, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true],
        ['id' => 16, 'status' => 1, 'title' => 'Record 1 Col 1', 'subtitle' => 'filament-kanban #11', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 0],
        ['id' => 17, 'status' => 1, 'title' => 'Record 2 Col 1', 'subtitle' => 'filament-kanban #21', 'sort' => 1, 'draggable' => true, 'click' => true, 'progress' => 10],
    ];

    protected function showProgress(): bool|array
    {
        return true;
    }

    public function submitRecord(): void
    {
        dd($this->record);
        $this->dispatch('close-modal', id: 'filament-kanban.record-modal');
    }

    public function recordDragged(array $event)
    {
        dd('record-dragged', $event);
    }

    public function recordSorted(array $event)
    {
        dd('record-sorted', $event);
    }

    public function recordClicked(array $event)
    {
        dd('record-sorted', $event);
    }
}
