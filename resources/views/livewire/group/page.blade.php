<div>
    <x-layout.centered-header>{{ $group->name }}</x-layout.centered-header>

    <div class="mx-auto w-full max-w-lg mt-8">

        <div class="grid grid-cols-1 gap-y-8">
            <div class="col-span-1">
                <h2 class="text-green-700 text-lg font-semibold">Leaderboard</h2>
                <div class="pt-6">
                    Leaderboard
                </div>
            </div>

            <div class="col-span-1">
                <h2 class="text-green-700 text-lg font-semibold">Group URL</h2>
                <div class="pt-6">
                    <p>Your group page can be accessed at the following URL:</p>
                    <p class="mt-4">
                        <a
                            class="text-green-600 hover:text-green-800 hover:underline" href="{{ $group->pageUrl }}"
                        >{{ $group->pageUrl }}</a>
                    </p>
                </div>
            </div>


            <div class="col-span-1 pt-6">
                <h2 class="text-green-700 text-lg font-semibold">Admin</h2>

                <div class="mt-4">
                    Your group is administered by <span class="font-bold">{{ $group->admin->name }}.</span>
                </div>

            </div>

        </div>
    </div>
</div>
