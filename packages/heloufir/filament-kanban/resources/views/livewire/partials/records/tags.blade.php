@if(isset($r['tags']) && sizeof($r['tags']))
    <div class="kanban-cell-tags w-full flex flex-row flex-wrap justify-start items-center gap-2 pt-2">
        @foreach($r['tags'] as $tag)
            <span class="px-2 py-1 rounded-full shadow border border-gray-200 dark:border-gray-800 text-xs text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-gray-100">
                {{ $tag }}
            </span>
        @endforeach
    </div>
@endif
