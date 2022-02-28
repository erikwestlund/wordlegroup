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

    public static function getFromUrlKey($urlKey)
    {
        if(! Str::contains($urlKey, '-')) {
            abort(404);
        }

        [$id, $key] = explode('-', $urlKey);

        return self::with('memberships.user')->where(compact('id', 'key'))->firstOrFail();
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class);
    }
}
