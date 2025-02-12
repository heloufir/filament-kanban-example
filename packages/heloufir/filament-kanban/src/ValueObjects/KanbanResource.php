<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;

class KanbanResource implements Arrayable
{

    protected string|int $id;
    protected string $name;
    protected string $avatar;

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

    function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function avatar(string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    function getAvatar(): string
    {
        return $this->avatar;
    }

    function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar,
        ];
    }
}
