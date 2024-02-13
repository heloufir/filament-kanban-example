<div
    :class="{'w-[330px] min-w-[330px]': !collapsedColumns.includes('{{$status['id']}}'), 'w-[70px] min-w-[70px]': collapsedColumns.includes('{{$status['id']}}')}"
    class="kanban-col relative overflow-y-hidden hover:overflow-y-auto h-full rounded-lg bg-slate-100 dark:bg-slate-800 border border-gray-200 dark:border-gray-900 flex flex-col">

    @include('filament-kanban::livewire.partials.column-header')

    <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3"
         :class="{'hidden': collapsedColumns.includes('{{$status['id']}}')}"
         data-status="{{ $status['id'] }}" data-draggable="{{ $status['draggable'] ?? true }}">

        @foreach($records as $r)

            @include('filament-kanban::livewire.partials.record')

        @endforeach

        <div class="kanban-col-fixer h-2 w-full">&nbsp;</div>

    </div>

</div>
