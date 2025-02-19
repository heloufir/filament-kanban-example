<x-filament::badge :color="method_exists($tag,'getColor') ? $tag->getColor() : 'gray'"
                   :icon="method_exists($tag,'getIcon') ? $tag->getIcon() : null">
    {!! method_exists($tag,'getLabel') ? $tag->getLabel() : $tag !!}
</x-filament::badge>
