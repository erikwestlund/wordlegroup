<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityFeed extends Component
{
    use WithPagination;

    public $group;

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function render()
    {
        return view('livewire.group.activity-feed', [
            'scores' => $this->group
                ->scores()
                ->with('user')
                ->latest('created_at')
                ->latest('date')
                ->paginate(6)
        ]);
    }
}
