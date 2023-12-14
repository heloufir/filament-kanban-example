<div
    class="kanban-col-title flex flex-row items-center gap-2 sticky top-0 bg-slate-100 dark:bg-slate-800 p-3" style="z-index: 1;">
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
