@if($r['delete'])
    <button wire:click="recordDelete({{$r['id']}})" class="kanban-cell-delete-btn absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-500 text-white flex flex-row items-center justify-center text-center shadow hover:shadow-lg">
        <x-heroicon-o-x-mark class="w-4"></x-heroicon-o-x-mark>
        <span class="tooltip py-1 px-3 rounded bg-red-700 text-white absolute w-24 right-7 text-xs text-center">
            @lang('filament-kanban::filament-kanban.record.delete')
        </span>
    </button>
@endif
