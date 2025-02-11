<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Gamez\Illuminate\Support\TypedCollection;

class KanbanResources extends TypedCollection
{
    protected static $allowedTypes = [KanbanResource::class];
}
