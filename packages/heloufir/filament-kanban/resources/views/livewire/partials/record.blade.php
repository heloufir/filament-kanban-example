<div
    class="kanban-cell @if(!($r['draggable'] ?? true) || !($status['draggable'] ?? true)) disable-draggable bg-gray-200 dark:bg-gray-800 border-gray-300 dark:border-gray-900 @else bg-white dark:bg-gray-600 border-gray-200 dark:border-gray-700 hover:shadow-lg hover:cursor-move @endif w-full p-3 rounded-lg border flex flex-col gap-2 relative"
    data-id="{{ $r['id'] }}" data-draggable="{{ $r['draggable'] ?? true }}">

    @include('filament-kanban::livewire.partials.records.delete-btn')

    @include('filament-kanban::livewire.partials.records.subtitle')

    @include('filament-kanban::livewire.partials.records.title')

    @include('filament-kanban::livewire.partials.records.avatars')

    <div class="kanban-cell-footer w-full flex flex-row items-center gap-2">

        @include('filament-kanban::livewire.partials.records.footer')

    </div>

    @include('filament-kanban::livewire.partials.records.tags')
</div>
