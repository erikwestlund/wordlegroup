<div>

    @unless(Auth::check())
        <x-layout.hr class="mt-20 mb-12"/>
        <div class="flex flex-col justify-center items-center">
            <x-layout.sub-heading>Interested in trying out Wordle Group?</x-layout.sub-heading>

            <div class="text-center mt-6">
                <p><a class="link" href="{{ route('group.create') }}">Create a new Wordle Group.</a></p>
            </div>

        </div>
    @endunless
</div>
