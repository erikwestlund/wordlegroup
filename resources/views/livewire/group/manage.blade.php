<div>
    <x-layout.heading>{{ $group->name }}</x-layout.heading>

    <div class="mx-auto w-full max-w-lg mt-8">

        <div class="grid grid-cols-1 gap-y-8">
            <div class="col-span-1">
                <h2 class="text-green-700 text-lg font-semibold">Group URL</h2>
                <div class="pt-6">
                    <p>Your group page can be accessed at the following URL:</p>
                    <p class="mt-4">
                        <a class="text-green-600 hover:text-green-800 hover:underline" href="{{ $group->pageUrl }}">{{ $group->pageUrl }}</a>
                    </p>
                </div>
            </div>
            <div class="col-span-1">
                <h2 class="text-green-700 text-lg font-semibold">Add Member</h2>
                <div class="pt-6">
                    <livewire:group.add-member :group="$group"/>
                </div>
            </div>

            <div class="col-span-1">
                <h2 class="text-green-700 text-lg font-semibold">Manage Members</h2>

                <div class="mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                            >Name
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Remove</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Odd row -->
                                        @foreach($group->memberships as $membership)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $membership->user->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                                    <button
                                                        class="text-green-600 hover:text-green-900"
                                                        onclick="confirm('Are you sure you want to remove {{ $membership->user->name }} from your group? Their scores will be lost.') || event.stopImmediatePropagation()"
                                                        wire:click="remove({{ $membership->id }}"
                                                    >Remove</button>
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
            </div>

            <div class="col-span-1 pt-6">
                <h2 class="text-green-700 text-lg font-semibold">Rename Group</h2>

                <livewire:group.rename :group="$group"/>
            </div>

        </div>
    </div>
</div>
