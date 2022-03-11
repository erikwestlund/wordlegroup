<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                    <tr>
                        <th
                            scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0"
                        >Name
                        </th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 text-right">
                            Games
                        </th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 text-right">
                            Mean
                        </th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 text-right">
                            Median
                        </th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 text-right">
                            Mode
                        </th>
                        @if($group->isAdmin(Auth::user()))
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 md:pr-0">
                                <span class="sr-only">Edit</span>
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($group->memberships as $membership)
                        <tr>
                            <td class="whitespace-nowrap py-4 text-sm pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                <div class="font-semibold text-gray-900">
                                    {{ $membership->user->name }}
                                </div>

                                @if(Auth::user()->id !== $membership->user->id && $membership->user->canBeNudged())
                                    <div>
                                        <button
                                            type="button"
                                            title="Send user a reminder to record their scores."
                                            class="text-sm text-green-700 hover:text-green-800 py-1 font-medium focus:ring-2 rounded focus:ring-offset-2 focus:ring-green-500"
                                            onclick="confirm('This will email {{ $membership->user->name }} a reminder to record their scores. Are you sure you want to continue?') || event.stopImmediatePropagation()"
                                            wire:click="nudge({{ $membership->user->id }})"
                                        >
                                            Nudge
                                        </button>
                                    </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ $membership->user->daily_scores_recorded }}</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ number_format($membership->user->daily_score_mean, 2) }}</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ number_format($membership->user->daily_score_median, 2) }}</td>
                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-right">{{ number_format($membership->user->daily_score_mode, 2) }}</td>
                        </tr>
                    @endforeach

                    <!-- More people... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
