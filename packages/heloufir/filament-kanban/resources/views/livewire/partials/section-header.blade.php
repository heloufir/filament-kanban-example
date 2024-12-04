<div
    class="kanban-section-title w-full flex flex-row justify-between items-center p-1" style="z-index: 1;">
    <div class="flex flex-row items-center">
        <span
            x-on:click="toggleElementInArray(collapsedColumns, '{{ $status['id'] }}')"
            class="text-lg text-gray-700 dark:text-gray-300 w-[32px] h[32px] min-w-[32px] min-h-[32px] rounded-full bg-transparent hover:bg-gray-200 dark:hover:bg-gray-700 flex flex-row justify-center items-center cursor-pointer">
            <span :class="{'hidden': collapsedColumns.includes('{{$status['id']}}')}">
                <x-heroicon-m-chevron-down class="w-5 h-5" />
            </span>
            <span :class="{'hidden': !collapsedColumns.includes('{{$status['id']}}')}">
                <x-heroicon-m-chevron-up class="w-5 h-5" />
            </span>
        </span>
        <span
            class="kanban-col-title-status text-sm font-bold text-gray-700 dark:text-gray-300">{{ $status['name'] }}</span>
    </div>
</div>
