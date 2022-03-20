<x-layout.page-container
    :heading="$title"
    :title="$title . ' - Wordle Group'"
>

    <x-layout.social-meta
        :title="$title . ' - Wordle Group'"
        url="{{ route('score.share-page', $score) }}"
        description="{{ $score->boardShareText }}"
    />

    <div class="mb-12 text-sm text-gray-500 text-center">
        {{ $score->date->format('l, F jS, Y') }}
    </div>

    <div class="flex justify-center text-4xl whitespace-nowrap whitespace-pre font-board">{!! $score->board !!}</div>

    <div class="mt-12 flex justify-center">
        <x-score.copy-button :score="$score" />
    </div>

    @if(! Auth::check())
        <x-layout.hr class="my-16"/>

        <div class="text-center">
            <a class="link" href="{{ route('home') }}">Create Your Own Wordle Group</a>
        </div>
    @endif
</x-layout.page-container>
