<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Gamez\Illuminate\Support\TypedCollection;
use Heloufir\FilamentKanban\Interfaces\KanbanRecordModel;

class KanbanRecords extends TypedCollection
{
    protected static $allowedTypes = [KanbanRecordModel::class];
}
