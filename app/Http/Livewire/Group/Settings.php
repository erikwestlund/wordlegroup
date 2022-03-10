<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Settings extends Component
{

    public $name;

    public $heading;

    public $public;

    public $group;

    public $adminUserId;

    protected function getRules()
    {
        return [
            'group.name'          => ['required'],
            'group.admin_user_id' => ['required'],
        ];
    }

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->heading = $group->name . ' Group Settings';

        $this->adminUserId = $this->group->admin_user_id;
    }

    public function updatedAdminUserId($value)
    {
        $this->group->admin_user_id = $value;
    }

    public function update()
    {
        $this->validate();

//        $this->group->admin_user_id = $this->adminUserId;
        $this->group->save();

        session()->flash('message', 'Settings saved.');

        return redirect()->to(route('group.settings', $this->group));
    }

    public function render()
    {
        return view('livewire.group.settings');
    }
}
