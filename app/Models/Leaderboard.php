<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'leaderboard' => 'collection',
    ];

    public function scopeGroup($query, $groupId)
    {
        return $query->where('group_id', $groupId);
    }

    public function scopeFor($query, $for)
    {
        return $query->where('for', $for);
    }

    public function scopeYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeMonth($query, $month)
    {
        return $query->where('month', $month);
    }

    public function scopeWeek($query, $week)
    {
        return $query->where('week', $week);
    }
}
