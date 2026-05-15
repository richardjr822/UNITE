<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'venue',
        'capacity',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->whereDate('date', '>=', now()->toDateString())
            ->where('status', 'scheduled');
    }

    public function getRegistrantsCountAttribute(): int
    {
        return (int) ($this->users_count ?? $this->users()->count());
    }

    public function getAvailableSlotsAttribute(): int
    {
        return max(0, $this->capacity - $this->registrants_count);
    }

    public function getIsFullAttribute(): bool
    {
        return $this->available_slots <= 0;
    }
}