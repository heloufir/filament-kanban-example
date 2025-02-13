<div class="w-full flex flex-row justify-start items-start gap-5 overflow-x-auto pb-5"
     x-show="activeTab === '{{ \Heloufir\FilamentKanban\enums\KanbanView::BOARD }}'">

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

            <div class="w-fit flex gap-5 overflow-y-auto overflow-x-hidden"
                 style="height: calc(100vh - 300px);">
                @foreach($statuses as $status)
                    <div
                        x-ref="sortable-{{ $status->getId() }}"
                        data-status-id="{{ $status->getId() }}"
                        wire:key="sortable-{{ $status->getId() }}"
                        class="flex flex-col gap-5 mt-3"
                        style="width: {{ $columnWidth }}; min-width: {{ $columnWidth }};">
                        @foreach($records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId()) as $record)
                            @include('filament-kanban::pages.partials.record')
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

    @endif

</div>
