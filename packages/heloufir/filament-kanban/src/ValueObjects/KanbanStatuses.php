<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Gamez\Illuminate\Support\TypedCollection;

class KanbanStatuses extends TypedCollection
{
    protected static $allowedTypes = [KanbanStatus::class];
}
