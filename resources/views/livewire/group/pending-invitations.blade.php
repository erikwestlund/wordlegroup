<div>
    <div class="mt-8 flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden border-b">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th scope="col" class="py-1.5 pl-2 pr-1.5 text-left text-sm font-semibold text-gray-900">
                                Name
                            </th>
                            <th scope="col" class="relative py-1.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                <span class="sr-only">Remind</span>
                            </th>
                            <th scope="col" class="relative py-1.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                <span class="sr-only">Uninvite</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($group->pendingInvitations as $invitation)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-2 pr-1.5 text-sm">
                                    <div class="text-gray-900 font-semibold">{{ $invitation->name }}</div>
                                    <div class="text-gray-500">{{ $invitation->email }}</div>
                                    <div class="mt-2 text-gray-400 text-xs">
                                        Invited {{ $invitation->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm  sm:pr-6 lg:pr-8">
                                    @if($invitation->reminded_at <= now()->subDay())
                                        <button
                                            type="button"
                                            class="p-2 rounded text-gray-600 font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
                                            onclick="confirm('This will email {{ $invitation->name }} a reminder. Are you sure you want to continue?') || event.stopImmediatePropagation()"
                                            wire:click="remind({{ $invitation->id }})"
                                        >Remind<span class="sr-only">, {{ $invitation->name }}</span></button>
                                    @else
                                        <span class="text-gray-500">
                                            Reminded {{ $invitation->reminded_at->diffForHumans() }}
                                        </span>
                                    @endif
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm  sm:pr-6 lg:pr-8">
                                    <button
                                        type="button"
                                        class="p-2 rounded text-gray-500 font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
                                        onclick="confirm('Are you sure you want to disinvited {{ $invitation->name }} from the group?') || event.stopImmediatePropagation()"
                                        wire:click="disinvite({{ $invitation->id }})"
                                    >Uninvite<span class="sr-only">, {{ $invitation->name }}</span></button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
