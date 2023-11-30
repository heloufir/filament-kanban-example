<div class="kanban-cel-progress-container w-full flex flex-row items-center gap-1">
    <div
        class="kanban-cel-progress w-full h-2 bg-slate-400 dark:bg-slate-700 rounded-full">
        <div
            class="kanban-cel-progress-bar bg-green-500 dark:bg-green-600 rounded-l-full @if($r['progress'] >= 100) rounded-r-full @endif h-2"
            style="width: {{ min(100, $r['progress']) }}%"></div>
    </div>
    <span class="kanban-cell-progress-value text-gray-400 dark:text-gray-200 text-xs">
        {{ $r['progress'] }}%
    </span>
</div>
