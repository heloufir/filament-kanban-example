<div class="kanban-cell-deadline w-[80px] min-w-[80px] max-w-[80px] {{ $this->deadlineColor($r['deadline']) }} text-gray-200 rounded p-1 text-xs flex flex-row justify-center items-center gap-1">
    <svg class="w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 15"><path d="M16 31a15 15 0 1 1 15-15 15 15 0 0 1-15 15Zm0-28a13 13 0 1 0 13 13A13 13 0 0 0 16 3Z" fill="#e5e7eb" class="fill-e5e7eb"></path><path d="m20.24 21.66-4.95-4.95A1 1 0 0 1 15 16V8h2v7.59l4.66 4.65Z" fill="#e5e7eb" class="fill-101820"></path></g></svg>
    <span>{{ $deadline }}</span>
</div>
