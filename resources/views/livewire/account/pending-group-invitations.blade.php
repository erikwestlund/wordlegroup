<div class="flex justify-center">
    <ul role="list" class="grid grid-cols-1 gap-5 sm:gap-6 w-full max-w-sm sm:max-w-md">
        @foreach($user->pendingGroupInvitations as $invitation)
            <li class="col-span-1 flex shadow-sm rounded-md justify-center ">
                <div class="flex flex-grow overflow-hidden">
                    <div
                        class="flex-shrink-0 flex items-center bg-wordle-yellow bg-green-700 justify-center w-16 text-white text-2xl font-bold rounded-l-md"
                    >
                        {{ substr($invitation->group->name, 0, 1)  }}
                    </div>
                    <div
                        class="flex-grow flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate"
                    >
                        <form class="flex-1 px-4 py-4 truncate mb-0" method="POST">
                            <span
                                class="text-gray-900 font-bold"
                            >{{ $invitation->group->name }}</span>
                            <p class="mt-0.5 text-gray-500 text-sm">
                                Invited {{ $invitation->created_at->diffForHumans() }} by <span
                                    class="font-semibold"
                                >{{ $invitation->group->admin->name }}</span>
                            </p>

                            <div class="mt-4">
                                <button
                                    type="button"
                                    class="px-4 py-2 border-2 border-transparent shadow-sm bg-wordle-yellow text-sm rounded text-white hover:bg-green-700 font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
                                    wire:click="accept({{ $invitation->id }})"
                                >
                                    Accept
                                </button>

                                <button
                                    type="button"
                                    class="px-4 py-2 border-2 border-transparent hover:border-gray-300 text-sm rounded text-gray-500 font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
                                    wire:click="decline({{ $invitation->id }})"
                                >
                                    Decline
                                </button>

                            </div>
                        </form>


                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>
