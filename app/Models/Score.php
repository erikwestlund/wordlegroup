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

    public function syncToGroups()
    {
        /**
         * If this was recorded by the user, just sync it to each group.
         */
        if ($this->recordedByUser()) {
            $this->user->memberships
                ->each(function ($membership) {
            // Need one to many relationship on memberships
            // Link scores using pivot
            // If owned, just sync.

            // If not owned, swap any scores matching it by user with these, and sync.
                });
        }
    }

}
