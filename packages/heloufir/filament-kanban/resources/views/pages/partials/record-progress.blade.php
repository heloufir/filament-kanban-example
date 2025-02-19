<div class="grid grid-cols-12 items-center gap-2">
    <div class="col-span-10 rounded h-2 bg-gray-100 dark:bg-gray-500/20">
        <div class="h-2 bg-green-500 dark:bg-green-700 rounded" style="width: {{ $record->getProgress() }}%;"></div>
    </div>
    <span class="col-span-2 text-xs">{{ $record->getProgress() }}%</span>
</div>
