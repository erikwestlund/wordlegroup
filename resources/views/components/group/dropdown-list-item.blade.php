<a href="{{ route('group.home', $groupMembership->group) }}">
    <div class="flex">
        <div class="font-bold text-green-700">{{ $groupMembership->group->name }}</div>
        <div>
        	@if($groupMembership->group->isAdmin($user))
            <x-group.admin-badge class="ml-2" text-size="text-xs" />
        	@endif
        </div>
    </div>
    <div class="mt-1">
        <ul class=" text-sm">
            @if($groupMembership->group->leaderboard && isset($groupMembership->group->leaderboard->first()['name']))
                <li class="mt-0.5 first:mt-0">
                    <span class="font-medium">Leader:</span>
                    {{ $groupMembership->group->leaderboard->first()['name']  }}, {{ number_format($groupMembership->group->leaderboard->first()['stats']['mean'], 2) }}
                </li>
                <li class="mt-0.5 first:mt-0">
                    <span class="font-medium">Avg. Score:</span>
                    {{ number_format($groupMembership->group->score_mean, 2) }}
                </li>
                @if($groupMembership->group->leaderboard->firstWhere('user_id', $user->id))
                <li class="mt-0.5 first:mt-0">
                    <span class="font-medium">My Place:</span>
                    {{ $groupMembership->group->leaderboard->firstWhere('user_id', $user->id)['place'] }}/{{ $groupMembership->group->leaderboard->pluck('place')->max() }}
                </li>
                @endif
            @endif
        </ul>
    </div>
</a>
