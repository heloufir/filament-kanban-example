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

    public function recordClick(int $record): void
    {
        $index = $this->recordIndexById($record);
        if ($this->records[$index]['click'] ?? true) {
            $this->dispatch('filament-kanban.record-clicked', [
                'record' => $record
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
