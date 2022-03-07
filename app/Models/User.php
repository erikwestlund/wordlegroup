<?php

namespace App\Models;

use App\Concerns\Tokens;
use App\Mail\UserVerification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Prunable, SoftDeletes;

    protected $dates = ['email_verified_at', 'auth_token_generated_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'auth_token',
        'auth_token_generated_at',
        'daily_scores_recorded',
        'daily_score_mean',
        'daily_score_median',
        'daily_score_mode',
        'score_distribution',
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

    public function getVerifyUrlAttribute()
    {
        return route('account.verify', $this) . '?token=' . $this->auth_token;
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

    public function sendEmailVerificationNotification()
    {
        $this->generateNewAuthToken();

        Mail::to($this->email)
            ->send(new UserVerification($this));
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

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function recordedGroupMembershipScores()
    {
        return $this->belongsToMany(Score::class, 'group_membership_score');
    }

    public function dailyScores()
    {
        return $this->belongsToMany(Score::class, 'user_score');
    }

    public function dailyScoresForBoard($boardNumber)
    {
        return $this->dailyScores()
                    ->wherePivot('board_number', $boardNumber);
    }

    public function getAverageScoreAttribute()
    {
        return $this->scores()
                    ->orderByRaw("FIELD(recording_user_id, {$this->id}) DESC")
                    ->orderByDesc('board_number')
                    ->groupBy('board_number')
                    ->get();
    }

    public function getMeanDailyScore()
    {
        return $this->dailyScores->isNotEmpty() ? (float)round($this->dailyScores()->average('score'), 2) : null;
    }

    public function getMedianDailyScore()
    {
        return $this->dailyScores->isNotEmpty() ? (float)round($this->dailyScores->median('score'), 1) : null;
    }

    public function getModeDailyScore()
    {
        return $this->dailyScores->isNotEmpty() ? collect($this->dailyScores->mode('score'))->min() : null;
    }

    public function updateStats()
    {
        $this->update([
            'daily_scores_recorded' => $this->dailyScores()->count(),
            'daily_score_mean'      => $this->getMeanDailyScore(),
            'daily_score_median'    => $this->getMedianDailyScore(),
            'daily_score_mode'      => $this->getModeDailyScore(),
            'score_distribution'    => $this->getScoreDistribution(),
        ]);
    }

    public function getScoreDistribution()
    {
        return collect([1, 2, 3, 4, 5, 6, 7])
            ->mapWithKeys(function ($number) {
                return [
                    $number === 7 ? 'X' : $number => $this->dailyScores->where('score', $number)->count(),
                ];
            });
    }
}
