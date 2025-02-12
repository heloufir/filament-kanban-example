<?php

namespace Heloufir\FilamentKanban\Interfaces;

use Heloufir\FilamentKanban\ValueObjects\KanbanRecord;

interface KanbanRecordModel
{
    function toRecord(): KanbanRecord;

    function statusColumn(): string;

    function sortColumn(): string;
}
