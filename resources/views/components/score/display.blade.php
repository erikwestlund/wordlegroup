<div {{ $attributes }}>
    <div class="flex justify-between items-center">
        <div class="px-6 py-3 w-1/2 font-semibold text-center border-r border-gray-100">#{{ $score->board_number }}</div>
        <div class="px-6 py-3 w-1/2 font-semibold text-center">{{ $score->score === 7 ? 'X' : $score->score }}/6</div>
    </div>
    <div class="flex justify-center items-center py-3 h-36 border-t border-gray-100 text-sm">
        <div class="whitespace-nowrap whitespace-pre font-board">{{ $score->board }}</div>
    </div>
    <div class="px-6 py-3 text-sm text-gray-500 border-t border-gray-100">{{ $score->date->format('M d, Y') }}</div>
</div>
