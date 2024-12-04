 <div
    class="kanban-section relative w-full {{ $loop->last ? '' : 'border-b' }} {{ $loop->index == 0 ? 'border-t' : '' }} border-gray-200 dark:border-gray-900 flex flex-col">

    @include('filament-kanban::livewire.partials.section-header')

    <div class="kanban-col-container w-full h-full px-3 flex flex-col"
         :class="{'hidden': collapsedColumns.includes('{{$status['id']}}')}"
         data-status="{{ $status['id'] }}" data-draggable="{{ $status['draggable'] ?? true }}">

        @foreach($records as $r)

            @include('filament-kanban::livewire.partials.list-item')

        @endforeach

    </div>

</div>
