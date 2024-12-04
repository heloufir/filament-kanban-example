<div class="w-full flex flex-row justify-start items-center gap-2 -my-5" style="z-index: 2;">
    <x-filament::button type="button" icon="heroicon-m-rectangle-group" size="xs" color="{{ $this->selectedKanbanView == 'kanban' ? 'primary' : 'gray' }}" wire:click="selectKanbanView('kanban')">
        @lang('filament-kanban::filament-kanban.views-buttons.kanban')
    </x-filament::button>
    <x-filament::button type="button" icon="heroicon-m-queue-list" size="xs" color="{{ $this->selectedKanbanView == 'list' ? 'primary' : 'gray' }}" wire:click="selectKanbanView('list')">
        @lang('filament-kanban::filament-kanban.views-buttons.list')
    </x-filament::button>
</div>
