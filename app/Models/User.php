<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'key'
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

    public static function firstOrCreateFromEmail($data)
    {
        $record = self::firstOrCreate($data);

        if ($record->password === null) {
            $record->update([
                'password' => bcrypt(uniqid('', false)),
            ]);
        }

        return $record;
    }

    public static function getFromUrlKey($urlKey)
    {
        if (!Str::contains($urlKey, '-')) {
            abort(404);
        }

        [$id, $key] = explode('-', $urlKey);

        return self::with('memberships')->where(compact('id', 'key'))->firstOrFail();
    }

    public function getAccountUrlAttribute()
    {
        return route('account', $this->urlKey);
    }

    public function getRecordScoreUrlAttribute()
    {
        return route('score.record', $this->urlKey);
    }

    public function getUrlKeyAttribute()
    {
        return $this->id . '-' . $this->key;
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class);
    }
}
