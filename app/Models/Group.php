<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUrlKeyAttribute()
    {
        return $this->id . '-' . $this->key;
    }

    public function getAdminUrlAttribute()
    {
        return route('group.manage', [$this->urlKey, $this->admin->urlKey]);
    }

    public function getPageUrlAttribute()
    {
        return route('group.page', $this->urlKey);
    }

    public static function getFromUrlKey($urlKey)
    {
        if(! Str::contains($urlKey, '-')) {
            abort(404);
        }

        [$id, $key] = explode('-', $urlKey);

        return self::with('memberships.user')->where(compact('id', 'key'))->firstOrFail();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class, 'group_id');
    }
}
