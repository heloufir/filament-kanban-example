<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Gamez\Illuminate\Support\TypedCollection;

class KanbanRecords extends TypedCollection
{
    protected static $allowedTypes = [KanbanRecord::class];
}
