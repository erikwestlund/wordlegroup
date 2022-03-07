<div
    class="grid grid-cols-1 @if($quick) gap-y-4 @endif"
    @if($quick)
    x-data="{show: 'haveBoard'}"
    @endif
>
    <div
        class="col-span-1"
        @if($quick)
        x-show="show === 'haveBoard'"
        @endif
    >
        <form wire:submit.prevent="recordScoreFromBoard" class="mb-0">
            @unless($quick)
                <h2 class="text-green-700 text-lg font-semibold">
                    @if($recordingForSelf)
                        I Have My Board
                    @else
                        I Have The Board
                    @endif
                </h2>
            @endunless

            <div class="grid grid-cols-a @if($quick) gap-y-4 @else gap-y-8 @endif">
                <div class="col-span-1">
                    <x-form.input.textarea
                        :errors="$errors"
                        name="board"
                        label="Board"
                        :rows="7"
                        :tip="$quick ? '' : 'Just paste in your board and we\'ll figure out the dare and score and save your board.'"
                        placeholder="Wordle 250 3/6..."
                        wire:model="board"
                        class="font-system"
                    />
                </div>

                <div class="col-span-1 flex items-center justify-between">
                    <x-form.input.button :primary="! $quick">
                        @if($recordingForSelf)
                            Record My Score
                        @else
                            Record Score
                        @endif
                    </x-form.input.button>
                    @if($quick)
                        <button
                            type="button"
                            class="text-sm text-green-700 hover:text-green-800"
                            @click="show = 'manual'"
                        >I don't have my board.
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div
        class="col-span-1"
        @if($quick)
        x-show="show === 'manual'"
        x-cloak
        @endif
    >
        <form class="mt-12" wire:submit.prevent="recordScoreManually" class="mb-0">

            @unless($quick)
                <h2 class="text-green-700 text-lg font-semibold">
                    @if($recordingForSelf)
                        I Don't Have My Board
                    @else
                        I Don't Have The Board
                    @endif
                </h2>
            @endunless

            <div class="grid grid-cols-a @if($quick) gap-y-4 @else gap-y-8 mt-8 @endif">

                <div class="col-span-1">
                    <x-form.input.date
                        :errors="$errors"
                        name="date"
                        label="Date"
                        :placeholder="$date"
                        :options="['defaultDate' => $date]"
                        wire:model="date"
                    />
                </div>

                <div class="col-span-1">
                    <x-form.input.text
                        :errors="$errors"
                        name="score"
                        type="number"
                        label="Score"
                        placeholder="3"
                        min="1"
                        max="6"
                        wire:model="score"
                    />
                    <div class="@if($errors->has('score')) mt-4 @else mt-1 @endif text-gray-500 text-sm">
                        Click the checkbox below if you missed.
                    </div>

                    <div class="mt-4 relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                id="bricked"
                                aria-describedby="bricked-out-x-out-of-6"
                                name="bricked"
                                type="checkbox"
                                wire:model="bricked"
                                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="comments" class="font-semibold text-gray-700">X/6</label>
                            <p id="comments-description" class="text-gray-500">Oops, I bricked out.</p>
                        </div>
                    </div>

                    <div class="mt-4 relative flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                id="hardMode"
                                aria-describedby="hard-mode"
                                name="hardMode"
                                type="checkbox"
                                wire:model="hardMode"
                                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="comments" class="font-semibold text-gray-700">Hard Mode</label>
                        </div>
                    </div>

                </div>

                <div class="col-span-1 flex items-center justify-between">
                    <x-form.input.button :primary="! $quick">
                        @if($recordingForSelf)
                            Record My Score
                        @else
                            Record Score
                        @endif
                    </x-form.input.button>
                    @if($quick)
                        <button
                            type="button"
                            class="text-sm text-green-700 hover:text-green-800"
                            @click="show = 'haveBoard'"
                        >I  have my board.
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
