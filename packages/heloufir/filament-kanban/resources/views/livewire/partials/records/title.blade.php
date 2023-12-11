<div class="kanban-cell-title-container w-full flex flex-row items-center justify-start gap-2">
    <a class="kanban-cell-title text-sm text-gray-700 dark:text-gray-100 font-medium @if($r['click'] ?? true) hover:underline hover:cursor-pointer @endif" wire:click="recordClick('{{ $r['id'] }}')">
        {!! $r['title'] !!}
    </a>
    @if($r['click'] ?? true)
        <div class="btn">
            <x-filament::icon-button @click="$wire.dispatch('filament-kanban.share-record', {id: '{{ $r['id'] }}'})" icon="heroicon-m-link" size="xs" color="info" label="{{ __('filament-kanban::filament-kanban.record.share.button') }}" />
        </div>
    @endif
</div>
