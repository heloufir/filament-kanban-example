@if($loadingActivated && $loading)
    <div id="kanban-loading" class="w-full h-full absolute top-0 left-0 right-0 bottom-0 bg-gray-900 bg-opacity-30 flex flex-row justify-center items-center z-50 rounded-lg gap-2">
        <x-icon name="heroicon-o-arrow-path" class="w-10 h-10 text-gray-900"/> <span class="text-gray-900 text-sm font-medium">@lang('filament-kanban::filament-kanban.loading')</span>
    </div>
@endif
