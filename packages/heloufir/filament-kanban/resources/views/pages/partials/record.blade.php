<div
    data-id="{{ $record->getId() }}"
    data-status-id="{{ $record->getStatus()->getId() }}"
    class="relative group hover:cursor-pointer w-full text-sm rounded-lg hover:shadow flex flex-col gap-2 bg-white p-3 dark:bg-gray-500/20 border dark:border-white/10 @if(!$record->isSortable()) no-drag @endif">
    <div
        class="z-20 absolute top-2 right-2 group-hover:flex hidden w-8 h-8 bg-gray-100 dark:bg-gray-500/20 items-center justify-center text-center hover:shadow rounded-lg">
        @include('filament-kanban::pages.partials.record-actions')
    </div>

    @if($record->getSubtitle())
        <div class="text-sm opacity-70 z-10">{!! $record->getSubtitle() !!}</div>
    @endif
    <div class="text-base">{!! $record->getTitle() !!}</div>
    @if($record->getDescription())
        <div class="pl-2 border-l-2">{{ Str::limit(strip_tags($record->getDescription()), 80) }}</div>
    @endif
    <div class="w-full items-center gap-3">
        @if($record->getProgress() !== null)
            @include('filament-kanban::pages.partials.record-progress')
        @endif
    </div>
    <div class="grid grid-cols-12 items-center gap-2 pt-2 mt-2 border-t border-gray-200 dark:border-white/10">
        @if($record->getAssignees() && $record->getAssignees()->isNotEmpty())
            <div class="col-span-8 flex flex-row items-center justify-start pl-3">
                @include('filament-kanban::pages.partials.record-assignees')
            </div>
        @else
            <div class="col-span-8"></div>
        @endif
        @if($record->getDeadline())
            <span
                class="col-span-4 text-center rounded text-xs bg-gray-100 py-1 px-2 dark:bg-gray-500/20">{{ $record->getDeadline()->format(config('filament-kanban.deadline-format')) }}</span>
        @endif
    </div>
    @if($record->getTags())
        <div class="w-full flex flex-row items-center gap-1 flex-wrap">
            @foreach($record->getTags() as $tag)
                @include('filament-kanban::pages.partials.record-tag')
            @endforeach
        </div>
    @endif
</div>
