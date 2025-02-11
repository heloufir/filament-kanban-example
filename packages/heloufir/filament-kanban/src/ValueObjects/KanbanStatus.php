<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;

class KanbanStatus implements Arrayable
{

    protected string|int $id;
    protected string $title;
    protected ?string $icon = null;
    protected ?string $color = null;

    static function make(): static
    {
        return new static();
    }

    function id(string|int $id): static
    {
        $this->id = $id;

        return $this;
    }

    function getId(): string|int
    {
        return $this->id;
    }

    function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    function getTitle(): string
    {
        return $this->title;
    }

    function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    function getIcon(): ?string
    {
        return $this->icon;
    }

    function color(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    function getColor(): ?string
    {
        return $this->color;
    }

    function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'icon' => $this->icon,
            'color' => $this->color,
        ];
    }
}
