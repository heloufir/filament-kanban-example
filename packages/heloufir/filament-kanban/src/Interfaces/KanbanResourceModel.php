<?php

namespace Heloufir\FilamentKanban\Interfaces;

use Heloufir\FilamentKanban\ValueObjects\KanbanResource;

interface KanbanResourceModel
{
    function toResource(): KanbanResource;
}
