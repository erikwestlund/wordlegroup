<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityFeed extends Component
{
    use WithPagination;

    public $anonymizePrivateUsers;

    public $group;

    public $filterByUserId;

    public $user;

    public $isGroupMember;

    public function mount(Group $group, $anonymizePrivateUsers = false)
    {
        $this->group = $group;
        $this->anonymizePrivateUsers = $anonymizePrivateUsers;
        $this->user = Auth::check() ? Auth::user() : null;
        $this->isGroupMember = $group->isMemberOf($this->user);
    }

    public function clearUserFilter()
    {
        $this->filterByUserId = null;
    }

    public function getScores()
    {
        $query = $this->group
            ->scores();

        if ($this->filterByUserId) {
            $query = $query->where('scores.user_id', $this->filterByUserId);
        }

        return $query->with('user')
                     ->latest('created_at')
                     ->latest('date')
                     ->paginate(6);

    }

    public function render()
    {
        return view('livewire.group.activity-feed', [
            'scores' => $this->getScores(),
        ]);
    }
}
