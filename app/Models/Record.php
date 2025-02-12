<?php

namespace App\Models;

use Heloufir\FilamentKanban\Interfaces\KanbanRecordModel;
use Heloufir\FilamentKanban\ValueObjects\KanbanRecord;
use Heloufir\FilamentKanban\ValueObjects\KanbanResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Record extends Model implements KanbanRecordModel
{

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'owner_id',
        'status_id',
        'progress',
    ];

    protected $casts = [
        'deadline' => 'date:Y-m-d',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assignees', 'record_id', 'user_id');
    }

    function toRecord(): KanbanRecord
    {
        return KanbanRecord::make()
            ->deletable(true)
            ->draggable(true)
            ->sortable(true)
            ->editable(true)
            ->viewable(true)
            ->id($this->id)
            ->title($this->title)
            ->description($this->description)
            ->deadline($this->deadline)
            ->progress($this->progress)
            ->assignees(
                KanbanResources::make(
                    $this->assignees
                )
            )
            ->status($this->status->toStatus());
    }
}
