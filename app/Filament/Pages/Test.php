<?php

namespace App\Filament\Pages;

use Heloufir\FilamentKanban\Livewire\Kanban;

class Test extends Kanban
{
    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

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
        ['id' => 1, 'status' => 2, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true],
        ['id' => 2, 'status' => 3, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true],
        ['id' => 3, 'status' => 3, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true],
        ['id' => 4, 'status' => 3, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false],
        ['id' => 5, 'status' => 3, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true],
        ['id' => 6, 'status' => 4, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true],
        ['id' => 7, 'status' => 4, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true],
        ['id' => 8, 'status' => 4, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true],
        ['id' => 9, 'status' => 4, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true],
        ['id' => 10, 'status' => 4, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true],
        ['id' => 11, 'status' => 4, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true],
        ['id' => 12, 'status' => 4, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true],
        ['id' => 13, 'status' => 4, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true],
        ['id' => 14, 'status' => 4, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true],
        ['id' => 15, 'status' => 4, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true],
    ];

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
