<?php

namespace App\Models;

use App\Casts\WordleDailyStartTime;
use App\Concerns\SyncsDailyScoreToGroupMemberships;
use App\Concerns\SyncsDailyScoreToUser;
use App\Concerns\UpdatesGroupStats;
use App\Concerns\WordleBoard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Score extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => WordleDailyStartTime::class,
    ];

    protected $guarded = [];

    public function getBoardAttribute($value)
    {
        return Str::replace('⬛', '⬜', $value);
    }

    public function getEndOfWordleDayAttribute()
    {
        return $this->date->addHours(24)->subMicrosecond();
    }

    public function membershipsScoreRecords()
    {
        return $this->belongsToMany(self::class, 'group_membership_score');
    }

    public function recordingUser()
    {
        return $this->belongsTo(User::class, 'recording_user_id');
    }

    public function scopeBoardNumber($query, $boardNumber)
    {
        return $query->where('board_number', $boardNumber);
    }

    public function scopeFor($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeOnWordleDay($query, $date)
    {
        return $query->boardNumber(app(WordleBoard::class)->getBoardNumberFromDate($date));
    }

    public function scopeRecordedBy($query, User $user)
    {
        return $query->where('recording_user_id', $user->id);
    }

    public function scopeRecordedByOwner($query, User $user)
    {
        return $query->whereRaw('user_id = recording_user_id');
    }

    public function scopeRecordingUserScoreFirst($query, $userId)
    {
        return $query->orderByRaw("FIELD(recording_user_id, '{$userId}') DESC");
    }

    public function syncToDailyScores()
    {
        app(SyncsDailyScoreToUser::class)->sync($this);
    }

    public function syncToGroupMemberships()
    {
        app(SyncsDailyScoreToGroupMemberships::class)->sync($this);
    }

    public function updateMemberGroupStats()
    {
        $this->user->memberships->each->updateGroupStats();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validForMembership(GroupMembership $membership)
    {
        // Must be from a board after joining group.
        // And by either recording user or graph admin.
        return $this->endOfWordleDay > $membership->created_at
            && (
                $this->recordedByUser() ||
                $this->recordedByAdmin($membership)
            );
    }

    public function recordedByUser()
    {
        return $this->user_id === $this->recording_user_id;
    }

    public function recordedByAdmin(GroupMembership $membership)
    {
        return $this->recording_user_id === $membership->group->admin->id;
    }
}
