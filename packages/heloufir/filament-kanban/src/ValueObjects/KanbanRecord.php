<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class KanbanRecord implements Arrayable
{

    protected string|int $id;
    protected string $title;
    protected KanbanStatus $status;
    protected KanbanResource $owner;
    protected ?KanbanResources $assignees = null;
    protected ?Carbon $deadline = null;
    protected ?array $tags = null;
    protected ?string $subtitle = null;
    protected ?string $description = null;
    protected ?float $progress = null;
    protected int $sort = 0;
    protected bool $draggable = false;
    protected bool $clickable = false;
    protected bool $sortable = false;
    protected bool $deletable = false;
    protected ?string $color = null;

    static function make(): static
    {
        return new static();
    }

    function getId(): int|string
    {
        return $this->id;
    }

    function id(int|string $id): static
    {
        $this->id = $id;

        return $this;
    }

    function getTitle(): string
    {
        return $this->title;
    }

    function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    function getStatus(): KanbanStatus
    {
        return $this->status;
    }

    function status(KanbanStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    function getOwner(): KanbanResource
    {
        return $this->owner;
    }

    function owner(KanbanResource $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    function getAssignees(): ?KanbanResources
    {
        return $this->assignees;
    }

    function assignees(?KanbanResources $assignees): static
    {
        $this->assignees = $assignees;

        return $this;
    }

    function getDeadline(): ?Carbon
    {
        return $this->deadline;
    }

    function deadline(?Carbon $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    function getTags(): ?array
    {
        return $this->tags;
    }

    function tags(?array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    function subtitle(?string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    function getDescription(): ?string
    {
        return $this->description;
    }

    function description(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    function getProgress(): ?float
    {
        return $this->progress;
    }

    function progress(?float $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    function getSort(): ?int
    {
        return $this->sort;
    }

    function sort(?int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    function isDraggable(): ?bool
    {
        return $this->draggable;
    }

    function draggable(?bool $draggable): static
    {
        $this->draggable = $draggable;

        return $this;
    }

    function isClickable(): ?bool
    {
        return $this->clickable;
    }

    function clickable(?bool $clickable): static
    {
        $this->clickable = $clickable;

        return $this;
    }

    function isSortable(): ?bool
    {
        return $this->sortable;
    }

    function sortable(?bool $sortable): static
    {
        $this->sortable = $sortable;

        return $this;
    }

    function isDeletable(): ?bool
    {
        return $this->deletable;
    }

    function deletable(?bool $deletable): static
    {
        $this->deletable = $deletable;

        return $this;
    }

    function getColor(): ?string
    {
        return $this->color;
    }

    function color(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status->toArray(),
            'owner' => $this->owner->toArray(),
            'assignees' => $this->assignees?->toArray(),
            'deadline' => $this->deadline,
            'tags' => $this->tags,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'progress' => $this->progress,
            'sort' => $this->sort,
            'draggable' => $this->draggable,
            'clickable' => $this->clickable,
            'sortable' => $this->sortable,
            'deletable' => $this->deletable,
            'color' => $this->color,
        ];
    }
}
