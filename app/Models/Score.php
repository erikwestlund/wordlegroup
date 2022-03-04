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

    protected $casts = [
        'date' => WordleDailyStartTime::class,
    ];

    protected $guarded = [];

    public function membershipsScoreRecords()
    {
        return $this->belongsToMany(self::class, 'group_membership_score');
    }

    public function getEndOfWordleDayAttribute()
    {
        return $this->date->addHours(24)->subMicrosecond();
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

    public function syncToGroupMemberships()
    {
        app(SyncsScoresToGroupMemberships::class)->sync($this);
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
