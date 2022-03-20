<?php

namespace App\Models;

use App\Casts\WordleDailyStartTime;
use App\Concerns\SyncsDailyScoreToGroupMemberships;
use App\Concerns\SyncsDailyScoreToUser;
use App\Concerns\UpdatesGroupStats;
use App\Concerns\WordleBoard;
use App\Concerns\WordleDate;
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

    public function getBoardShareTextAttribute()
    {
        $board = $this->boardTitle . "\n\n" .
            $this->board;

        return $board;
    }

    public function getBoardShareTextWithUrlAttribute()
    {
        $board = $this->boardShareText;

        if ($this->user->public_profile || $this->public) {
            $board .= "\n\n" .
                route('score.share-page', $this);
        }

        return $board;
    }

    public function getBoardTitleAttribute()
    {
        return "Wordle {$this->board_number} " . $this->scoreDisplay . "/6" . ($this->hard_mode ? '*' : '');
    }

    public function getEndOfWordleDayAttribute()
    {
        return app(WordleDate::class)->getActiveBoardEndTime()->subMicrosecond();
    }

    public function getPublicAttribute()
    {
        return (bool)$this->shared_at;
    }

    public function getScoreDisplayAttribute()
    {
        return $this->score === 7 ? 'X' : $this->score;
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

    public function scoreCannotBeSeenByUser(User $viewingUser = null)
    {
        return !$this->scoreCanBeSeenByUser($viewingUser);
    }

    public function scoreCanBeSeenByUser(User $viewingUser = null)
    {
        // If it's public
        if ($this->public) {
            return true;
        }

        // If anonymous and not public, no.
        if (!$viewingUser) {
            return false;
        }

        // If the viewing user is the user.
        if ($this->id === $viewingUser->id) {
            return true;
        }

        // If the viewing user is in a group with the user.
        if ($this->user->sharesGroupMembershipWithAnotherUser($viewingUser)) {
            return true;
        }

        return false;
    }

    public function scopeToday($query)
    {
        return $query->where('board_number', app(WordleDate::class)->activeBoardNumber);
    }

    public function boardCannotBeSeenByUser(User $viewingUser = null)
    {
        return !$this->boardCanBeSeenByUser($viewingUser);
    }

    public function boardCanBeSeenByUser(User $viewingUser = null)
    {
        // If score has been actively shared.
        if ($this->public) {
            return true;
        }

        // If today is past the board day.
        if (app(WordleDate::class)->todayIsAfterBoardNumberDay($this->board_number)) {
            return true;
        }

        // If user is not in any of your groups,

        // If user has submitted their score today.
        if ($viewingUser->recordedScoreToday()) {
            return true;
        }

        return false;
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
