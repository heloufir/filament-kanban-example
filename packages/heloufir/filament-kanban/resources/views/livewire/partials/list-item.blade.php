<div
    class="kanban-cell @if(!($r['draggable'] ?? true) || !($status['draggable'] ?? true)) disable-draggable bg-gray-100 dark:bg-gray-800 border-gray-300 dark:border-gray-900 @else bg-transparent dark:bg-gray-900 border-gray-200 dark:border-gray-700 hover:shadow-lg hover:bg-gray-100 hover:dark:bg-gray-800 hover:cursor-move @endif w-full p-2 {{ $loop->last ? '' : 'border-b' }} {{ $loop->index == 0 ? 'border-t' : '' }} flex flex-row justify-between items-center gap-2 relative"
    data-id="{{ $r['id'] }}" data-draggable="{{ $r['draggable'] ?? true }}">

    @include('filament-kanban::livewire.partials.records.delete-btn')

    <div class="w-2/4 flex flex-col gap-2">
        @include('filament-kanban::livewire.partials.records.title')
    </div>

    <div class="w-1/4 flex flex-col gap-2">

        @include('filament-kanban::livewire.partials.records.avatars', ['avatarStart' => true])
    </div>

    <div class="w-1/4 flex flex-row items-center gap-2">

        @if(isset($r['deadline']) && $deadline = $this->formatDeadline($r['deadline']))

            @include('filament-kanban::livewire.partials.records.footer-deadline')

        @endif

    </div>
</div>
