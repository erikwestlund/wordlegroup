<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 border-b">
                    <thead>
                    <tr>
                        <th scope="col" class="w-16 pl-1 pr-3 py-1 sm:px-4 sm:py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><span class="inline sm:hidden">Place</span><span class="hidden sm:inline">Place</span></th>
                        <th scope="col" class="px-1 py-1 sm:px-4 sm:py-2 w-full text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="whitespace-nowrap text-right px-2 py-1 sm:py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><span class="inline sm:hidden">Avg.</span><span class="hidden sm:inline">Avg. Score</span></th>
                        <th scope="col" class="whitespace-nowrap text-right px-2 py-1 sm:py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><span class="inline sm:hidden">Num.</span><span class="hidden sm:inline">Games</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leaderboard->leaderboard as $position)
                    <tr class="bg-white">
                        <td class="text-center pl-1 pr-3 py-2 sm:px-4 sm:py-2 whitespace-nowrap @if(isset($group->leaderboard[$loop->index + 1]['place']) && $group->leaderboard[$loop->index + 1]['place'] != $position['place']) border-b border-gray-200 @endif">
                            @if($position['place'] === 1)
                                <span class="h-10 md:h-12 w-10 md:w-12 inline-flex items-center justify-center text-lg bg-gold text-black font-extrabold rounded-full">{{ $position['place'] }}</span>
                            @elseif($position['place'] === 2)
                                <span class="h-10 w-10 inline-flex items-center justify-center text-lg bg-silver text-black font-bold rounded-full">{{ $position['place'] }}</span>
                            @elseif($position['place'] === 3)
                                <span class="h-8 w-8 inline-flex items-center justify-center text-lg bg-bronze text-black font-bold rounded-full">{{ $position['place'] }}</span>
                            @else
                                <span class="text-sm font-medium">{{ $position['place'] }}</span>
                            @endif
                        </td>
                        <td class="px-1 py-2 sm:px-4 sm:py-2 whitespace-nowrap truncate @if(isset($group->leaderboard[$loop->index + 1]['place']) && $group->leaderboard[$loop->index + 1]['place'] != $position['place']) border-b border-gray-200 @endif
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-bold sm:font-bold
                            @elseif($position['place'] === 3)
                            text-sm font-bold
                            @else
                            text-sm text-gray-900 font-medium
                            @endif
                        " title="{{ $position['name'] }}">@if($anonymizePrivateUsers && $position['user']->private_profile) Anonymous User @else {{ $position['name'] }} @endif</td>
                        <td class="px-2 py-2 sm:py-2 whitespace-nowrap text-right @if(isset($group->leaderboard[$loop->index + 1]['place']) && $group->leaderboard[$loop->index + 1]['place'] != $position['place']) border-b border-gray-200 @endif
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-bold sm:font-bold
                            @elseif($position['place'] === 3)
                            text-sm font-bold
                            @else
                            text-sm text-gray-900 font-medium
                            @endif
                        ">{!! $position['stats']['mean'] ?: "&#x2014;" !!}</td>
                        <td class="px-2 py-2 sm:py-2 whitespace-nowrap  text-right @if(isset($group->leaderboard[$loop->index + 1]['place']) && $group->leaderboard[$loop->index + 1]['place'] != $position['place']) border-b border-gray-200 @endif
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-bold sm:font-bold
                            @elseif($position['place'] === 3)
                            text-sm font-bold
                            @else
                            text-sm text-gray-900 font-medium
                            @endif
                        ">{{ $position['stats']['count'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
