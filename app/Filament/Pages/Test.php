<?php

namespace App\Filament\Pages;

use Heloufir\FilamentKanban\Livewire\Kanban;

class Test extends Kanban
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Filament Kanban';

    protected $listeners = [
        'filament-kanban.record-dragged' => 'recordDragged',
        'filament-kanban.record-sorted' => 'recordSorted',
    ];

    public array $statuses = [
        ['id' => 1, 'name' => 'Draft', 'color' => 'gray'],
        ['id' => 2, 'name' => 'Submitted', 'color' => 'blue'],
        ['id' => 3, 'name' => 'Changes requested', 'color' => 'orangered'],
        ['id' => 4, 'name' => 'Published', 'color' => 'green'],
    ];

    public array $records = [
        ['id' => 1, 'status' => 2, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 1],
        ['id' => 2, 'status' => 3, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 1],
        ['id' => 3, 'status' => 3, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 2],
        ['id' => 4, 'status' => 3, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 3],
        ['id' => 5, 'status' => 3, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 4],
        ['id' => 6, 'status' => 4, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 1],
        ['id' => 7, 'status' => 4, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 2],
        ['id' => 8, 'status' => 4, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 3],
        ['id' => 9, 'status' => 4, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 4],
        ['id' => 10, 'status' => 4, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 5],
        ['id' => 11, 'status' => 4, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 6],
        ['id' => 12, 'status' => 4, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 7],
        ['id' => 13, 'status' => 4, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 8],
        ['id' => 14, 'status' => 4, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 9],
        ['id' => 15, 'status' => 4, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 10],
    ];

    public function recordDragged(array $event)
    {
        dd('record-dragged', $event);
    }

    public function recordSorted(array $event)
    {
        dd('record-sorted', $event);
    }
}
