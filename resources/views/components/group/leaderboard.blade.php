<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th scope="col" class="w-16 pl-1 pr-3 py-1 sm:px-4 sm:py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><span class="inline sm:hidden">Pl.</span><span class="hidden sm:inline">Place</span></th>
                        <th scope="col" class="px-1 py-1 sm:px-4 sm:py-2 w-full text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="whitespace-nowrap text-right px-2 py-1 sm:py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><span class="inline sm:hidden">Avg.</span><span class="hidden sm:inline">Avg. Score</span></th>
                        <th scope="col" class="whitespace-nowrap text-right px-2 py-1 sm:py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><span class="inline sm:hidden">Num.</span><span class="hidden sm:inline">Games</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->leaderboard as $position)
                    <tr class="bg-white">
                        <td class="text-center pl-1 pr-3 py-1 sm:px-4 sm:py-2 whitespace-nowrap
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold bg-gold text-black
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-semibold bg-silver text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm sm:text-sm font-semibold bg-bronze text-orange-50
                            @else
                            text-xs font-medium text-gray-900
                            @endif
                        ">{{ $position['place'] }}</td>
                        <td class="px-1 py-1 sm:px-4 sm:py-2 whitespace-nowrap truncate
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold bg-gold text-black
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-bold sm:font-bold bg-silver text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm sm:text-sm font-semibold bg-bronze text-orange-50
                            @else
                            text-sm sm:text-sm text-gray-900
                            @endif
                        " title="{{ $position['name'] }}">{{ $position['name'] }}</td>
                        <td class="px-2 py-1 sm:py-2 whitespace-nowrap text-right
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold bg-gold text-black
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-bold sm:font-bold bg-silver text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm sm:text-sm font-semibold bg-bronze text-orange-50
                            @else
                            text-sm sm:text-sm text-gray-900
                            @endif
                        ">{!! $position['stats']['mean'] ?: "&#x2014;" !!}</td>
                        <td class="px-2 py-1 sm:py-2 whitespace-nowrap  text-right
                            @if($position['place'] === 1)
                            text-base sm:text-xl font-bold bg-gold text-black
                            @elseif($position['place'] === 2)
                            text-sm sm:text-lg font-bold sm:font-bold bg-silver text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm sm:text-sm font-semibold bg-bronze text-orange-800
                            @else
                            text-sm sm:text-sm text-gray-900
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
