<div class="w-full flex flex-row justify-start items-start gap-5 overflow-x-auto pb-5"
     x-show="activeTab === '{{ \Heloufir\FilamentKanban\enums\KanbanView::BOARD }}'"
     wire:key="kanban-board-view">

    @if($statuses->isEmpty())
        <x-filament::section class="w-full">
            <div class="w-full flex flex-col justify-center items-center">
                <div
                    class="w-12 h-12 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20 flex items-center justify-center mb-4">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5"/>
                </div>
                <span
                    class="text-base font-semibold leading-6 text-gray-950 dark:text-white">@lang('filament-kanban::filament-kanban.empty-state')</span>
            </div>
        </x-filament::section>
    @else

        <div class="w-full flex flex-col gap-3">
            <div class="w-fit flex gap-5">
                @foreach($statuses as $status)
                    @include('filament-kanban::pages.partials.status')
                @endforeach
            </div>

            @php($columnHeight = 230)
            @php($maxStatusesCount = 0)
            <div class="relative flex gap-5 overflow-auto" style="height: calc(100vh - 350px); width: calc(({{ $columnWidth }} * {{ $statuses->count() }}) + ({{ $statuses->count() - 1 }} * 1.25rem));">
                @foreach($statuses as $status)
                    @php($statusRecords = $records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId()))
                    @php($maxStatusesCount = max($maxStatusesCount, $statusRecords->count()))
                    <div
                        x-ref="sortable-{{ $status->getId() }}"
                        data-status-id="{{ $status->getId() }}"
                        wire:key="sortable-{{ $status->getId() }}"
                        class="flex flex-col gap-5 mt-3 absolute top-0 bottom-0"
                        style="width: {{ $columnWidth }}; min-width: {{ $columnWidth }}; left: calc(({{ $loop->index }} * {{ $columnWidth }}) + ({{ $loop->index }} * 1.25rem)); height: calc({{ $maxStatusesCount }} * {{ $columnHeight }}px);">
                        @foreach($statusRecords as $record)
                            @include('filament-kanban::pages.partials.record')
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

    @endif

</div>
