<?php

namespace Heloufir\FilamentKanban\Livewire;

use Filament\Pages\Page;
use Livewire\Attributes\On;

class Kanban extends Page
{

    protected static string $view = 'filament-kanban::livewire.kanban';

    /**
     * /!\ Must override when implemeting this page
     * Get the kanban columns
     * @return array
     * @author https://github.com/heloufir
     */
    protected function statuses(): array
    {
        return [];
    }

    /**
     * /!\ Must override when implemeting this page
     * Get the kanban records
     * @return array
     * @author https://github.com/heloufir
     */
    protected function records(): array
    {
        return [];
    }

    #[On('filament-kanban.record-drag')]
    public function recordDrag(int $record, int $source, int $target, int $oldIndex, int $newIndex)
    {
        $item = $this->recordById($record);
        if ($item) {
            $item['status'] = $target;
            $this->dispatch('filament-kanban.record-dragged', [
                'record' => $record,
                'source' => $source,
                'target' => $target,
                'old_index' => $oldIndex,
                'new_index' => $newIndex
            ]);
        }
    }

    #[On('filament-kanban.record-sort')]
    public function recordSort(int $record, int $source, int $target, int $oldIndex, int $newIndex)
    {
        $this->dispatch('filament-kanban.record-sorted', [
            'record' => $record,
            'source' => $source,
            'target' => $target,
            'old_index' => $oldIndex,
            'new_index' => $newIndex
        ]);
    }

    /**
     * Get records based on a status id
     * @param int $status
     * @return array
     * @author https://github.com/heloufir
     */
    protected function recordsByStatus(int $status): array
    {
        return array_filter($this->records(), fn($item) => $item['status'] === $status);
    }

    /**
     * Get record by ID
     * @param int $id
     * @return array|null
     * @author https://github.com/heloufir
     */
    protected function recordById(int $id): ?array
    {
        return array_values(array_filter($this->records(), fn($item) => $item['id'] === $id))[0] ?? null;
    }
}
