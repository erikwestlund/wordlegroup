<button
    @if($primary)
        {{ $attributes->merge([
            'class' => 'justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500'
        ]) }}
    @else
        {{ $attributes->merge([
              'class' => 'justify-center px-4 py-2 border border-gray-200 hover:border-gray-300 rounded-md text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500'
          ]) }}
    @endif
>
    <span
        class="inline-flex items-center"
        wire:loading.remove
        @if($loadingAction)wire:target="{{ $loadingAction }}"@endif
    >
        {{ $slot }}
    </span>
    <span
        class="inline-flex items-center"
        wire:loading
        @if($loadingAction)wire:target="{{ $loadingAction }}"@endif
    >
        <x-layout.loading-spinner />
    </span>
</button>
