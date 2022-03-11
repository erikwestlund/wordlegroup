<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityFeed extends Component
{
    use WithPagination;

    public $anonymizePrivateUsers;

    public $group;

    public function mount(Group $group, $anonymizePrivateUsers = false)
    {
        $this->group = $group;
        $this->anonymizePrivateUsers = $anonymizePrivateUsers;
    }

    public function render()
    {
        return view('livewire.group.activity-feed', [
            'scores' => $this->group
                ->scores()
                ->with('user')
                ->latest('created_at')
                ->latest('date')
                ->paginate(6),
        ]);
    }
}
