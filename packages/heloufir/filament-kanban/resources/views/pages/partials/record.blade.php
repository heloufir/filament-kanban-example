<div
    data-id="{{ $record->getId() }}"
    data-status-id="{{ $record->getStatus()->getId() }}"
    class="relative group hover:cursor-pointer w-full text-sm rounded-lg hover:shadow flex flex-col gap-2 bg-white p-3 dark:bg-gray-500/20 border dark:border-white/10 @if(!$record->isSortable()) no-drag @endif">
    <div class="absolute top-2 right-2 group-hover:flex hidden w-8 h-8 bg-gray-100 dark:bg-gray-500/20 items-center justify-center text-center hover:shadow rounded-lg">
        @include('filament-kanban::pages.partials.record-actions')
    </div>

    @if($record->getSubtitle())
        <span class="text-xs opacity-70">{{ $record->getSubtitle() }}</span>
    @endif
    <span class="text-base">{{ $record->getTitle() }}</span>
    @if($record->getDescription())
        <div class="pl-2 border-l-2">{{ Str::limit(strip_tags($record->getDescription()), 80) }}</div>
    @endif
    <div class="w-full grid grid-cols-12 items-center gap-3">
        @if($record->getDeadline())
            <span class="col-span-4 text-center rounded text-xs bg-gray-100 py-1 px-2 dark:bg-gray-500/20">{{ $record->getDeadline()->format(config('filament-kanban.deadline-format')) }}</span>
        @endif
        @if($record->getProgress() !== null)
            <div class="col-span-8 grid grid-cols-12 items-center gap-2">
                <div class="col-span-10 rounded h-2 bg-gray-100 dark:bg-gray-500/20">
                    <div class="h-2 bg-green-500 dark:bg-green-700 rounded" style="width: {{ $record->getProgress() }}%;"></div>
                </div>
                <span class="col-span-2 text-xs">{{ $record->getProgress() }}%</span>
            </div>
        @endif
    </div>
    @if($record->getAssignees() && $record->getAssignees()->isNotEmpty())
        <div class="w-full flex flex-row items-center justify-start pl-3 pt-2 mt-2 border-t border-gray-200 dark:border-white/10">
            @php($recordAssigneesTake = 5)
            @php($recordAssignees = $record->getAssignees()->take($recordAssigneesTake)->map(fn (\Heloufir\FilamentKanban\Interfaces\KanbanResourceModel $item) => $item->toResource()))
            @foreach($recordAssignees as $recordAssignee)
                <img src="{{ $recordAssignee->getAvatar() }}" class="border-2 border-gray-100 dark:border-gray-700 w-10 h-10 -ml-3 rounded-full" title="{{ $recordAssignee->getName() }}" alt="{{ $recordAssignee->getName() }}" />
            @endforeach
            @if($recordAssignees->count() > $recordAssigneesTake)
                <span class="text-xs ml-2">+{{ $recordAssignees->count() - $recordAssigneesTake }}</span>
            @endif
        </div>
    @endif
</div>
