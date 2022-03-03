<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    public function syncToGroupMemberships()
    {
        // If this is a user-provided score, sync it to all groups.
        // If it's an admin provided score, sync it only to the group the admin is sharing to.
        // Put an "admin_group_id" or some such on the score record.
//
//        // Get earliest user recorded score from that day, taking the latest first.
//        $userRecordedLatestScore = static::latest()
//                                     ->where([
//                                         'user_id'           => $this->user_id,
//                                         'recording_user_id' => $this->user_id,
//                                         'board_number'      => $this->board_number,
//                                     ])
//                                     ->latest()
//                                     ->first();
//
//
//        // If not,
//
//        $adminRecordedLatestScore = static::latest()
//                                     ->where([
//                                         'user_id'      => $this->user_id,
//                                         'board_number' => $this->board_number,
//                                     ])
//                                     ->where('recording_user_id', '!=', $this->user_id)
//                                     ->first();
//
//
//
//        // Prioritize latest score.
//        $score = $userRecordedLatestScore ?? $adminRecordedLatestScore;
//
//        return [
//            $userRecordedLatestScore,
//            $adminRecordedLatestScore,
//        ];
    }

}
