<div x-data="{show: true}" x-show="show">
    <div
        class="w-full flex items-center justify-center p-2 text-sm {{ $bgColor }} border-b {{ $borderColor }} {{ $textColor }} text-center w-full"
    >
        {{ $slot }}
        <button
            class="mx-2 px-1 py-1 text-semibold rounded {{ $buttonIconBg }}"
            type="button" @click="show=false"
        >
            <x-icon-regular.xmark :class="'h-4 w-4 ' . $buttonIconFill . ' ' . $buttonIconHoverFill"/>
        </button>
    </div>
</div>
