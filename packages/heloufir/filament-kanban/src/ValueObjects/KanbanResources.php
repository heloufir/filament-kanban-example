<?php

namespace Heloufir\FilamentKanban\ValueObjects;

use Gamez\Illuminate\Support\TypedCollection;
use Heloufir\FilamentKanban\Interfaces\KanbanResourceModel;

class KanbanResources extends TypedCollection
{
    protected static $allowedTypes = [KanbanResourceModel::class];
}
