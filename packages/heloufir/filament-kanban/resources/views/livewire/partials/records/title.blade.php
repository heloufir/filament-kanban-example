<a class="kanban-cel-title text-sm text-gray-700 dark:text-gray-100 font-medium @if($r['click'] ?? true) hover:underline hover:cursor-pointer @endif" wire:click="recordClick({{ $r['id'] }})">
    {!! $r['title'] !!}
</a>
