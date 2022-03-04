<?php

namespace App\Models;

use App\Casts\WordleDailyStartTime;
use App\Concerns\SyncsScoresToGroupMemberships;
use App\Concerns\WordleBoard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => WordleDailyStartTime::class,
    ];

    public function recordedByUser()
    {
        return $this->user_id === $this->recording_user_id;
    }

    public function recordedByAdmin()
    {
        return $this->user_id !== $this->recording_user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recordingUser()
    {
        return $this->belongsTo(User::class, 'recording_user_id');
    }

    public function scopeFor($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeRecordedBy($query, User $user)
    {
        return $query->where('recording_user_id', $user->id);
    }

    public function scopeRecordedByOwner($query, User $user)
    {
        return $query->whereRaw('user_id = recording_user_id');
    }

    public function scopeBoardNumber($query, $boardNumber)
    {
        return $query->where('board_number', $boardNumber);
    }

    public function scopeOnWordleDay($query, $date)
    {
        return $query->boardNumber(app(WordleBoard::class)->getBoardNumberFromDate($date));
    }

    public function validForMembership(GroupMembership $membership)
    {
        return $this->endOfWordleDay > $membership->created_at;
    }

    public function getEndOfWordleDayAttribute()
    {
        return $this->date->addHours(24)->subMicrosecond();
    }

    public function syncToGroupMemberships()
    {
        app(SyncsScoresToGroupMemberships::class)->sync($this);
    }

}
