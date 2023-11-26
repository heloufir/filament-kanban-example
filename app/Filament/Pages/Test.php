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
        ['id' => 1, 'status' => 2, 'title' => 'Record 1 Col 2', 'subtitle' => 'filament-kanban #12', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 20, 'owner' => 1, 'assignees' => [2, 3, 4, 5]],
        ['id' => 2, 'status' => 3, 'title' => 'Record 1 Col 3', 'subtitle' => 'filament-kanban #13', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 30, 'owner' => 2, 'assignees' => [2]],
        ['id' => 3, 'status' => 3, 'title' => 'Record 2 Col 3', 'subtitle' => 'filament-kanban #23', 'sort' => 1, 'draggable' => false, 'click' => true, 'owner' => 3, 'assignees' => [3]],
        ['id' => 4, 'status' => 3, 'title' => 'Record 3 Col 3', 'subtitle' => 'filament-kanban #33', 'sort' => 2, 'draggable' => true, 'click' => false, 'owner' => 4, 'assignees' => [3, 4]],
        ['id' => 5, 'status' => 3, 'title' => 'Record 4 Col 3', 'subtitle' => 'filament-kanban #43', 'sort' => 3, 'draggable' => true, 'click' => true, 'progress' => 35, 'owner' => 5, 'assignees' => [5]],
        ['id' => 6, 'status' => 4, 'title' => 'Record 1 Col 4', 'subtitle' => 'filament-kanban #14', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 40, 'owner' => 1, 'assignees' => [4]],
        ['id' => 7, 'status' => 4, 'title' => 'Record 2 Col 4', 'subtitle' => 'filament-kanban #24', 'sort' => 1, 'draggable' => true, 'click' => true, 'progress' => 50, 'owner' => 2, 'assignees' => [3, 5]],
        ['id' => 8, 'status' => 4, 'title' => 'Record 3 Col 4', 'subtitle' => 'filament-kanban #34', 'sort' => 2, 'draggable' => true, 'click' => true, 'owner' => 3, 'assignees' => [2, 4]],
        ['id' => 9, 'status' => 4, 'title' => 'Record 4 Col 4', 'subtitle' => 'filament-kanban #44', 'sort' => 3, 'draggable' => true, 'click' => true, 'progress' => 100, 'owner' => 4],
        ['id' => 10, 'status' => 4, 'title' => 'Record 5 Col 4', 'subtitle' => 'filament-kanban #54', 'sort' => 4, 'draggable' => true, 'click' => true, 'progress' => 80, 'owner' => 5],
        ['id' => 11, 'status' => 4, 'title' => 'Record 6 Col 4', 'subtitle' => 'filament-kanban #64', 'sort' => 5, 'draggable' => true, 'click' => true, 'progress' => 75, 'owner' => 1, 'assignees' => [2]],
        ['id' => 12, 'status' => 4, 'title' => 'Record 7 Col 4', 'subtitle' => 'filament-kanban #74', 'sort' => 6, 'draggable' => true, 'click' => true, 'progress' => 90, 'owner' => 3, 'assignees' => [2]],
        ['id' => 13, 'status' => 4, 'title' => 'Record 8 Col 4', 'subtitle' => 'filament-kanban #84', 'sort' => 7, 'draggable' => true, 'click' => true, 'progress' => 85, 'owner' => 4, 'assignees' => [3]],
        ['id' => 14, 'status' => 4, 'title' => 'Record 9 Col 4', 'subtitle' => 'filament-kanban #94', 'sort' => 8, 'draggable' => true, 'click' => true, 'owner' => 4, 'assignees' => [1]],
        ['id' => 15, 'status' => 4, 'title' => 'Record 10 Col 4', 'subtitle' => 'filament-kanban #104', 'sort' => 9, 'draggable' => true, 'click' => true, 'owner' => 5, 'assignees' => [1, 2]],
        ['id' => 16, 'status' => 1, 'title' => 'Record 1 Col 1', 'subtitle' => 'filament-kanban #11', 'sort' => 0, 'draggable' => true, 'click' => true, 'progress' => 0, 'owner' => 1, 'assignees' => [3, 4, 5]],
        ['id' => 17, 'status' => 1, 'title' => 'Record 2 Col 1', 'subtitle' => 'filament-kanban #21', 'sort' => 1, 'draggable' => true, 'click' => true, 'progress' => 10, 'owner' => 2, 'assignees' => [6]],
    ];

    public array $resources = [
        ['id' => 1, 'name' => 'Alex Roe'],
        ['id' => 2, 'name' => 'Taylor Nox', 'avatar' => 'https://robohash.org/4551ed2a34c28d96abdba7cbe1a97141?set=set4&bgset=bg2&size=200x200'],
        ['id' => 3, 'name' => 'Morgan Blake'],
        ['id' => 4, 'name' => 'Jordan Frost', 'avatar' => 'https://ui-avatars.com/api/?background=f97316&color=fff7ed&size=200&name=Jordan Frost'],
        ['id' => 5, 'name' => 'Casey Quinn'],
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
