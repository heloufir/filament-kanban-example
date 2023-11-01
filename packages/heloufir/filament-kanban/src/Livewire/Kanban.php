<?php

namespace Heloufir\FilamentKanban\Livewire;

use Filament\Pages\Page;
use Livewire\Attributes\On;

class Kanban extends Page
{

    protected static string $view = 'filament-kanban::livewire.kanban';

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

    #[On('filament-kanban.record-drag')]
    public function recordDrag(int $record, int $source, int $target, int $oldIndex, int $newIndex)
    {
        $index = $this->recordIndexById($record);
        if ($this->records[$index] ?? null) {
            $this->records[$index]['status'] = $target;
            $this->records[$index]['sort'] = $newIndex;
            $reorderedRecords = $this->reorderRecords($target, $record, $newIndex);
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

    #[On('filament-kanban.record-sort')]
    public function recordSort(int $record, int $source, int $target, int $oldIndex, int $newIndex)
    {
        $index = $this->recordIndexById($record);
        if ($this->records[$index] ?? null) {
            $this->records[$index]['sort'] = $newIndex;
            $reorderedRecords = $this->reorderRecords($target, $record, $newIndex);
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
     * @param int $target
     * @param int $record
     * @param int $newIndex
     * @return array
     * @author https://github.com/heloufir
     */
    protected function reorderRecords(int $status, int $record, int $index): array
    {
        $reorderedRecords = [];
        $records = array_filter($this->recordsByStatus($status), fn($item) => $item['sort'] >= $index && $item['id'] != $record);
        foreach ($records as $item) {
            $recordIndex = $this->recordIndexById($item['id']);
            $oldIndex = $this->records[$recordIndex]['sort'];
            $newIndex = $oldIndex + 1;
            $this->records[$recordIndex]['sort'] = $newIndex;
            $reorderedRecords[] = ['record' => $item['id'], 'old_index' => $oldIndex, 'new_index' => $newIndex];
        }
        return $reorderedRecords;
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
}
