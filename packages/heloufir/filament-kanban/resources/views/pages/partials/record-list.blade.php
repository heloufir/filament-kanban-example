<div
    data-id="{{ $record->getId() }}"
    data-status-id="{{ $record->getStatus()->getId() }}"
    class="relative group hover:cursor-pointer w-full text-sm rounded-lg hover:shadow grid grid-cols-6 items-center gap-2 bg-white p-3 dark:bg-gray-500/20 border dark:border-white/10 @if(!$record->isSortable()) no-drag @endif">
    <div class="col-span-2 flex flex-col gap-1">
        @if($record->getSubtitle())
            <span class="text-xs opacity-70">{{ $record->getSubtitle() }}</span>
        @endif
        <span class="text-base">{{ $record->getTitle() }}</span>
        @if($record->getProgress() !== null)
            @include('filament-kanban::pages.partials.record-progress')
        @endif
        @if($record->getTags())
            <div class="w-full flex flex-row items-center gap-1 flex-wrap">
                @foreach($record->getTags() as $tag)
                    @include('filament-kanban::pages.partials.record-tag')
                @endforeach
            </div>
        @endif
    </div>
    <div class="col-span-2">
        @if($record->getAssignees() && $record->getAssignees()->isNotEmpty())
            <div class="w-full flex flex-row items-center justify-start pl-3">
                @include('filament-kanban::pages.partials.record-assignees')
            </div>
        @endif
    </div>
    <div class="col-span-1">
        @if($record->getDeadline())
            <span class="col-span-4 text-center rounded text-xs bg-gray-100 py-1 px-2 dark:bg-gray-500/20">{{ $record->getDeadline()->format(config('filament-kanban.deadline-format')) }}</span>
        @endif
    </div>
    <div class="flex items-center justify-end col-span-1">
        <div class="flex w-8 h-8 bg-gray-100 dark:bg-gray-500/20 items-center justify-center text-center hover:shadow rounded-lg">
            @include('filament-kanban::pages.partials.record-actions')
        </div>
    </div>
</div>
