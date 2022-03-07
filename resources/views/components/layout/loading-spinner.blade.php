<span {{ $attributes }}>
    @if($defaultIconClasses)
        @svg("{$family}.{$icon}", ['class' => 'fill-current spin w-5 h-5'])
    @else
        @svg("{$family}.{$icon}", ['class' => 'fill-current spin ' . $iconClasses])
    @endif
</span>
