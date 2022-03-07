<?php

namespace App\Models;

use App\Concerns\Tokens;
use App\Mail\SendGroupMembershipInvitation;
use App\Mail\UserVerification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GroupMembershipInvitation extends Model
{
    use HasFactory, Prunable;

    protected $guarded = [];

    protected $hidden = ['token'];

    public function invitingUser()
    {
        return $this->belongsTo(User::class, 'inviting_user_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }


    public function generateNewAuthToken()
    {
        $this->update([
            'token' => app(Tokens::class)->generate(),
        ]);
    }

    public static function createInvitation(Group $group, $email, $name, User $invitingUser = null)
    {
        $invitation = self::create([
            'email'            => $email,
            'name'             => $name,
            'group_id'         => $group->id,
            'inviting_user_id' => $invitingUser->id ?? Auth::id(),
            'token'            => app(Tokens::class)->generate(),
        ]);

        $invitation->sendInvitationEmail();
    }

    public function sendInvitationEmail()
    {
        Mail::to($this->email)
            ->send(new SendGroupMembershipInvitation($this));
    }

    public function getInvitationUrlAttribute()
    {
        return route('group.invitation', $this) . '?token=' . $this->token;
    }

    public function prunable()
    {
        return static::where('created_at', '<=',
            now()->subDays(config('settings.unverified_group_membership_expires_days')));
    }
}
