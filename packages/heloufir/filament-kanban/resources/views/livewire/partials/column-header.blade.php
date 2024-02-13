<div
    :class="{'hidden': collapsedColumns.includes('{{$status['id']}}')}"
    class="kanban-col-title flex flex-row justify-between items-center sticky top-0 bg-slate-100 dark:bg-slate-800 p-3" style="z-index: 1;">
    <div class="flex flex-row items-center gap-2">
        @if(isset($status['icon']))
            <x-filament::icon
                icon="{{$status['icon']}}"
                class="h-4 w-4"
                style="color: {{ $status['color'] ?? 'gray' }};"
            />
        @else
            <div class="kanban-col-title-color w-3 h-3 rounded-full border-2"
                 style="border-color: {{ $status['color'] ?? 'gray' }};"></div>
        @endif
        <span
            class="kanban-col-title-status text-sm font-medium text-gray-700 dark:text-gray-300">{{ $status['name'] }}</span>
        <span
            class="kanban-col-title-badge bg-slate-200 dark:bg-slate-700 p-0.5 text-xs rounded text-gray-500 dark:text-gray-300">{{ sizeof($records) }}</span>
    </div>

    @if($this->enableCollapsibleColumns)
        <span
            x-on:click="toggleElementInArray(collapsedColumns, '{{ $status['id'] }}')"
            class="text-lg text-gray-700 dark:text-gray-300 w-[32px] h[32px] min-w-[32px] min-h-[32px] rounded-full bg-transparent hover:bg-gray-200 dark:hover:bg-gray-700 flex flex-row justify-center items-center cursor-pointer">
            <x-heroicon-o-chevron-left class="w-5 h-5" />
        </span>
    @endif
</div>

<div
    :class="{'hidden': !collapsedColumns.includes('{{$status['id']}}')}"
    class="kanban-col-title flex flex-row items-center gap-2 relative top-0 bg-slate-100 dark:bg-slate-800 p-3 rotate-90" style="z-index: 1;">
    <div class="flex flex-row items-center gap-2 absolute left-9">
        <span
            x-on:click="toggleElementInArray(collapsedColumns, '{{ $status['id'] }}')"
            class="text-lg text-gray-700 dark:text-gray-300 mr-5 w-[32px] h[32px] min-w-[32px] min-h-[32px] rounded-full bg-transparent hover:bg-gray-200 dark:hover:bg-gray-700 flex flex-row justify-center items-center cursor-pointer">
            <x-heroicon-o-chevron-up class="w-5 h-5" />
        </span>

        @if(isset($status['icon']))
            <x-filament::icon
                icon="{{$status['icon']}}"
                class="h-4 w-4"
                style="color: {{ $status['color'] ?? 'gray' }};"
            />
        @else
            <div class="kanban-col-title-color w-3 h-3 rounded-full border-2"
                 style="border-color: {{ $status['color'] ?? 'gray' }};"></div>
        @endif
        <span
            class="kanban-col-title-status text-sm font-medium text-gray-700 dark:text-gray-300">{{ $status['name'] }}</span>
        <span
            class="kanban-col-title-badge bg-slate-200 dark:bg-slate-700 p-0.5 text-xs rounded text-gray-500 dark:text-gray-300">{{ sizeof($records) }}</span>
    </div>
</div>
