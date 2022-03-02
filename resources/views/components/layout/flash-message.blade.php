<div x-data="{show: true}" x-show="show">
    <div
        class="w-full flex items-center justify-center p-2 text-sm {{ $bgColor }} border-b {{ $borderColor }} {{ $textColor }} text-center w-full"
    >
        {{ $slot }}
        <button
            class="mx-2 px-1 text-semibold" type="button" @click="show=false"
        >
            <x-icon-regular.check :class="$buttonIconFill . ' ' . $buttonIconHoverFill"/>
        </button>
    </div>
</div>
