<?php

namespace Heloufir\FilamentKanban\Interfaces;

use Heloufir\FilamentKanban\ValueObjects\KanbanStatus;

interface KanbanStatusModel
{
    function toStatus(): KanbanStatus;
}
