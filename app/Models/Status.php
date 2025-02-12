<?php

namespace App\Models;

use Heloufir\FilamentKanban\Interfaces\KanbanStatusModel;
use Heloufir\FilamentKanban\ValueObjects\KanbanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model implements KanbanStatusModel
{

    protected $fillable = [
        'title',
        'icon',
        'color',
    ];

    public function records(): HasMany
    {
        return $this->hasMany(Record::class, 'status_id');
    }

    function toStatus(): KanbanStatus
    {
        return KanbanStatus::make()
            ->id($this->id)
            ->title($this->title)
            ->icon($this->icon)
            ->color($this->color);
    }
}
