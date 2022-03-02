<?php

namespace App\Models;

use App\Concerns\Tokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Prunable;

    protected $dates = ['email_verified_at', 'auth_token_generated_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'auth_token',
        'auth_token_generated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'auth_token',
        'auth_token_generated_at',
    ];

    public function getAccountUrlAttribute()
    {
        return route('account', $this);
    }

    public function verified()
    {
        return $this->email_verified_at !== null;
    }

    public function verifyEmail()
    {
        $this->update(['email_verified_at' => now()]);
    }

    public function generateNewAuthToken()
    {
        $this->update([
            'auth_token'              => app(Tokens::class)->generate(),
            'auth_token_generated_at' => now(),
        ]);
    }

    public function getLoginUrlAttribute()
    {
        return route('login') . '?id=' . $this->id . '&token=' . $this->auth_token;
    }

    public function scopeTokenNotExpired($query)
    {
        return $query->where('auth_token_generated_at', '>', now()->subDay());
    }

    public function tokenExpired()
    {
        return $this->auth_token_generated_at < now()->subHours(config('settings.auth_token_valid_hours'));
    }

    public function tokenNotExpired()
    {
        return !$this->tokenExpired();
    }

    public function validateAuthToken($authToken)
    {
        return $this->tokenNotExpired() && $this->auth_token === $authToken;
    }

    public function resetAuthToken()
    {
        $this->update(['auth_token' => null, 'auth_token_generated_at' => null]);
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class);
    }

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subMinutes(config('settings.unverified_user_expires_minutes')))
                     ->whereNull('email_verified_at');
    }
}
