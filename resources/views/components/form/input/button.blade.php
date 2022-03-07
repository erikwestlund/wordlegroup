<button
    @if($primary)
        {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500'
        ]) }}
    @else
        {{ $attributes->merge([
              'type' => 'submit',
              'class' => 'inline-flex items-center px-4 py-2 border border-gray-200 hover:border-gray-300 text-base rounded-md text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500'
          ]) }}
    @endif
>
    {{ $slot }}
</button>
