<?php

namespace App\Rules;

use App\Models\Group;
use App\Models\GroupMembership;
use Illuminate\Contracts\Validation\Rule;

class OnlyOneUserPerGroup implements Rule
{
    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function passes($attribute, $value)
    {
        return false;
    }

    public function message()
    {
        return 'Only use user per group.';
    }
}
