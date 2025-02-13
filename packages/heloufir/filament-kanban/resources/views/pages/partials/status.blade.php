<div
    class="flex flex-col"
    style="width: {{ (isset($fullWidth) && $fullWidth) ? '100%' : $columnWidth }}; min-width: {{ (isset($fullWidth) && $fullWidth) ? '100%' : $columnWidth }};">
    <div class="w-full flex items-center gap-1 p-3 rounded-lg border dark:border-white/10 @if(!$status->getColor()) bg-white dark:bg-gray-500/20 @endif"
         @if($status->getColor()) style="background-color: {{ $status->getColor() }};" @endif>
        @if($status->getIcon())
            <x-filament::icon :icon="$status->getIcon()" class="w-4 h-4 text-gray-700"/>
        @endif
        <span
            class="text-sm font-normal leading-6 text-gray-700 @if(!$status->getColor()) dark:text-white @endif">{{ $status->getTitle() }}</span>
        <span
            class="flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-1.5 min-w-[theme(spacing.5)] py-0.5 tracking-tight bg-gray-50 ring-gray-600/10 ml-auto text-gray-700">{{ $records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId())->count() }}</span>
    </div>
</div>
