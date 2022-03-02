<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class GroupMembershipInvitation extends Model
{
    use HasFactory, Prunable;

    protected $hidden = ['token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDays(config('settings.unverified_group_membership_expires_days')));
    }
}
