<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th scope="col" class="w-16 px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Place</th>
                        <th scope="col" class="px-4 py-2 w-full text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="whitespace-nowrap text-right px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Avg. Score</th>
                        <th scope="col" class="whitespace-nowrap text-right px-4 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Games</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->leaderboard as $position)
                    <tr class="bg-white">
                        <td class="text-center px-4 py-2 whitespace-nowrap
                            @if($position['place'] === 1)
                            text-xl font-bold bg-yellow-200 text-yellow-700
                            @elseif($position['place'] === 2)
                            text-lg font-semibold bg-gray-200 text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm font-medium bg-orange-100 text-orange-800
                            @else
                            text-xs font-medium text-gray-900
                            @endif
                        ">{{ $position['place'] }}</td>
                        <td class="px-4 py-2 whitespace-nowrap
                            @if($position['place'] === 1)
                            text-xl font-bold bg-yellow-200 text-yellow-700
                            @elseif($position['place'] === 2)
                            text-lg font-semibold bg-gray-200 text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm font-medium bg-orange-100 text-orange-800
                            @else
                            text-sm text-gray-900
                            @endif
                        ">{{ $position['name'] }}</td>
                        <td class="pl-4 pr-5 py-2 whitespace-nowrap  text-right
                            @if($position['place'] === 1)
                            text-xl font-bold bg-yellow-200 text-yellow-700
                            @elseif($position['place'] === 2)
                            text-lg font-semibold bg-gray-200 text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm font-medium bg-orange-100 text-orange-800
                            @else
                            text-sm text-gray-900
                            @endif
                        ">{!! $position['stats']['mean'] ?: "&#x2014;" !!}</td>
                        <td class="pl-4 pr-5 py-2 whitespace-nowrap  text-right
                            @if($position['place'] === 1)
                            text-xl font-bold bg-yellow-200 text-yellow-700
                            @elseif($position['place'] === 2)
                            text-lg font-semibold bg-gray-200 text-gray-800
                            @elseif($position['place'] === 3)
                            text-sm font-medium bg-orange-100 text-orange-800
                            @else
                            text-sm text-gray-900
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
