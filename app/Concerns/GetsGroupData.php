<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Cache;

trait GetsGroupData
{
    public function getGroupWithMemberships($group)
    {
        $key = 'group-' . $group->id . '-with-memberships-' . $group->updated_at->timestamp;

        return Cache::remember(
            $key,
            60 * 60,
            function() use($group) {
                return $group->load(['memberships.user']);
            },
        );
    }
}
