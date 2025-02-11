<?php

namespace App\Models;

use Heloufir\FilamentKanban\Interfaces\KanbanRecordModel;
use Heloufir\FilamentKanban\ValueObjects\KanbanRecord;
use Heloufir\FilamentKanban\ValueObjects\KanbanResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Record extends Model implements KanbanRecordModel
{

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'owner_id',
        'status_id',
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
            ->id($this->id)
            ->title($this->title)
            ->description($this->description)
            ->deadline($this->deadline)
            ->assignees(
                KanbanResources::make(
                    $this->assignees->map(fn(User $assignee) => $assignee->toResource())
                )
            )
            ->status($this->status->toStatus());
    }
}
