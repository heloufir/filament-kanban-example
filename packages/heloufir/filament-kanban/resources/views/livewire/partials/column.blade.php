<div
    class="kanban-col overflow-y-hidden hover:overflow-y-auto w-[330px] min-w-[330px] h-full rounded-lg bg-slate-100 dark:bg-slate-800 border border-gray-200 dark:border-gray-900 flex flex-col">

    @include('filament-kanban::livewire.partials.column-header')

    <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3"
         data-status="{{ $status['id'] }}" data-draggable="{{ $status['draggable'] ?? true }}">

        @foreach($records as $r)

            @include('filament-kanban::livewire.partials.record')

        @endforeach

    </div>

</div>
