<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Heloufir\FilamentKanban\Interfaces\KanbanResourceModel;
use Heloufir\FilamentKanban\ValueObjects\KanbanResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, KanbanResourceModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function assignedRecords(): HasManyThrough
    {
        return $this->hasManyThrough(Record::class, Assignee::class, 'user_id', 'record_id');
    }

    function toResource(): KanbanResource
    {
        return KanbanResource::make()
            ->id($this->id)
            ->name($this->name)
            ->avatar('https://ui-avatars.com/api/?name=' . $this->name . 'D&color=FFFFFF&background=09090b');
    }
}
