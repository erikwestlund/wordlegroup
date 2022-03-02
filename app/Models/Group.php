<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Str;

class Group extends Model
{
    use HasFactory;
    use Prunable;

    protected $dates = ['verified_at'];

    protected $guarded = [];

    protected $hidden = [
        'token',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function getVerifyUrlAttribute()
    {
        return route('group.verify', $this) . '?token=' . $this->token;
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class, 'group_id');
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subMinutes(config('settings.unverified_group_expires_minutes')))
                     ->whereNull('verified_at');
    }

    public function verify()
    {
        $this->update(['verified_at' => now(), 'token' => null]);
    }
}
