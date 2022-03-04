<div {{ $attributes }}>
    <div class="font-semibold">Wordle {{ $score->board_number }}: {{ $score->score }}/6</div>
    <div class="py-1">
        <div class="whitespace-pre whitespace-nowrap font-board">{{ $score->board }}</div>
    </div>
    <div class="text-gray-500 text-sm">{{ $score->date->format('M d, Y') }}</div>
</div>
