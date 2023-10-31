<?php

namespace Heloufir\FilamentKanban\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Kanban extends Component
{

    public function render()
    {
        return view('filament-kanban::livewire.kanban');
    }

    #[On('filament-kanban.record-dragged')]
    public function recordDragged(int $record, int $source, int $target, int $oldIndex, int $newIndex)
    {
        dd('record dragged', $record, $source, $target, $oldIndex, $newIndex);
    }

    #[On('filament-kanban.record-sorted')]
    public function recordSorted(int $record, int $source, int $target, int $oldIndex, int $newIndex)
    {
        dd('record sorted', $record, $source, $target, $oldIndex, $newIndex);
    }
}
