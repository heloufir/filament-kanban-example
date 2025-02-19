<div
    class="flex flex-col"
    style="width: {{ (isset($fullWidth) && $fullWidth) ? '100%' : $columnWidth }}; min-width: {{ (isset($fullWidth) && $fullWidth) ? '100%' : $columnWidth }};">
    <div class="relative w-full flex items-center gap-1 p-3 rounded-lg border-2 @if(!$status->getColor()) dark:border-white/10 @endif"
         @if($status->getColor()) style="border-color: {{ $status->getColor() }}; color: {{ $status->getColor() }};" @endif>
        @if($status->getColor())
            <div class="absolute top-0 left-0 right-0 bottom-0 w-full h-full opacity-10 rounded-lg" style="background-color: {{ $status->getColor() }}"></div>
        @endif
        @if($status->getIcon())
            <x-filament::icon :icon="$status->getIcon()" class="w-4 h-4 text-gray-950 dark:text-white"/>
        @endif
        <span
            class="text-sm font-normal leading-6 text-gray-950 dark:text-white">{{ $status->getTitle() }}</span>
        <span
            class="flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-1.5 min-w-[theme(spacing.5)] py-0.5 tracking-tight bg-gray-50 ring-gray-600/10 ml-auto text-gray-700">{{ $records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId())->count() }}</span>
    </div>
</div>
