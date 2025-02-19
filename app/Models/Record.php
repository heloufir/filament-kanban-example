<?php

namespace App\Models;

use Heloufir\FilamentKanban\Interfaces\KanbanRecordModel;
use Heloufir\FilamentKanban\ValueObjects\KanbanRecord;
use Heloufir\FilamentKanban\ValueObjects\KanbanResources;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\HtmlString;

class Record extends Model implements KanbanRecordModel
{

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'owner_id',
        'status_id',
        'progress',
        'sort',
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
        return KanbanRecord::make($this)
            ->deletable(true)
            ->sortable(true)
            ->editable(true)
            ->viewable(true)
            ->id($this->id)
            ->title($this->title)
            ->subtitle('#' . $this->id)
            ->description($this->description)
            ->progress($this->progress)
            ->deadline($this->deadline)
            ->tags(['Filament', 'Kanban', 'Plugin'])
            ->assignees(
                KanbanResources::make(
                    $this->assignees
                )
            )
            ->status($this->status->toStatus());
    }

    function statusColumn(): string
    {
        return 'status_id';
    }

    function sortColumn(): string
    {
        return 'sort';
    }
}
