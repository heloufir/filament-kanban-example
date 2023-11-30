<div
    class="kanban-cell-avatars-owner bg-cover bg-center bg-no-repeat w-8 h-8 rounded-full shadow relative flex flex-col justify-center items-center"
    style="background-image: url('{{ $this->getResourceAvatar($item) }}')">
    <span class="tooltip py-1 px-3 rounded bg-gray-700 text-white absolute w-24 right-9 text-xs text-center">{{ $this->getResourceName($item) }}</span>
</div>
