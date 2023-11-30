<div
    class="kanban-cell-avatars w-full flex flex-wrap flex-row justify-end items-center gap-0.5">
    @if(isset($r['owner']) && $this->getResourceName($r['owner']))

        @include('filament-kanban::livewire.partials.records.avatar', ['item' => $r['owner']])

    @endif
    @if(isset($r['assignees']))
        @foreach($r['assignees'] as $assignee)
            @if($this->getResourceName($assignee))

                    @include('filament-kanban::livewire.partials.records.avatar', ['item' => $assignee])

            @endif
        @endforeach
    @endif
</div>
