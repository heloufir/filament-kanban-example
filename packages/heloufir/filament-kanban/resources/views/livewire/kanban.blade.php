<x-filament-panels::page>

    @if($this->showFilters)
        @include('filament-kanban::livewire.kanban-filters')
    @endif

    <div class="kanban w-full overflow-x-hidden hover:overflow-x-auto flex flex-row gap-3"
         @if(config('filament-kanban.kanban-height')) style="height: {{ config('filament-kanban.kanban-height') }}px;" @endif>

        @foreach($this->statuses as $status)
            @php
                $records = $this->recordsByStatus($status['id']);
            @endphp

            @include('filament-kanban::livewire.partials.column')
        @endforeach

    </div>

    <x-filament::modal id="filament-kanban.record-modal" slide-over sticky-header width="2xl">
        <x-slot name="heading">
            {{ $modalMode === 'update' ? ($record['title'] ?? '') : __('filament-kanban::filament-kanban.modal.create') }}
        </x-slot>

        <form wire:submit="submitRecord">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-6">
                Submit
            </x-filament::button>
        </form>
    </x-filament::modal>

    @if(!config('filament-kanban.kanban-height'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.kanbanUtilities.kanbanResizeHeight();
            });
        </script>
    @endif

</x-filament-panels::page>
