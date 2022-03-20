<x-layout.page-container heading="Create A New Wordle Group" title="Group a Wordle Group">
    <x-layout.social-meta
        title="Create A Wordle Group"
        :url="route('group.create')"
        description="Create a Wordle Group to keep score with your friends in Wordle."
    />
    <div class=" flex justify-center ">
        <div class="w-full max-w-sm">
            <livewire:group.create-form/>
        </div>
    </div>
</x-layout.page-container>

