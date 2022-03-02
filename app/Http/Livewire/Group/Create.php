<?php

namespace App\Http\Livewire\Group;

use App\Concerns\Tokens;
use App\Events\GroupCreated;
use App\Events\GroupMembershipCreated;
use App\Events\UnverifiedGroupCreated;
use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $email;

    public $groupName;

    public $userName;



    protected function getRules()
    {
        return [
            'groupName' => 'required',
            'email'     => [
                Rule::requiredIf(!Auth::check()),
                'email',
                'unique:users'
            ],
            'userName'  => Rule::requiredIf(!Auth::check()),
        ];
    }

    public function store()
    {
        $this->validate();

        $user = Auth::check()
            ? Auth::user()
            : User::firstOrCreate([
                'email' => $this->email,
                'name'  => $this->userName,
            ]);

        $group = Group::create([
            'admin_user_id' => $user->id,
            'name'          => $this->groupName,
            'verified_at'   => Auth::check() ? now() : null,
            'token'         => Auth::check() ? null : app(Tokens::class)->generate(),
        ]);

        if (Auth::check()) {
            event(new GroupCreated($group));
        } else {
            event(new UnverifiedGroupCreated($group));
        }

        $groupMembership = GroupMembership::create([
            'group_id'    => $group->id,
            'user_id'     => $user->id,
            'verified_at' => Auth::check() ? now() : null,
        ]);

        return Auth::check()
            ? redirect()->to(route('group.home', $group))
            : redirect()->to(route('group.verify-email-notification', $group));
    }

    public function render()
    {
        return view('livewire.group.create');
    }
}
