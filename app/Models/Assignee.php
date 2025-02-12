<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignee extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ['record_id', 'user_id'];

    protected $fillable = [
        'record_id',
        'user_id',
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
