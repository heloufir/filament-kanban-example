<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Gamez\Illuminate\Support\TypedCollection;
use Heloufir\FilamentKanban\Interfaces\KanbanStatusModel;

class KanbanStatuses extends TypedCollection
{
    protected static $allowedTypes = [KanbanStatusModel::class];
}
