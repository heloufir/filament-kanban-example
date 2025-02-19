<div class="w-full flex flex-row justify-start items-start gap-5 overflow-x-auto pb-5"
     x-show="activeTab === '{{ \Heloufir\FilamentKanban\enums\KanbanView::LIST }}'"
     wire:key="kanban-list-view">

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

        @if($showStatusesAsTabs)
            <div class="w-full flex flex-col gap-5">
                <x-filament::tabs class="w-full">

                    @foreach($statuses as $status)
                        <x-filament::tabs.item
                            :icon="$status->getIcon()"
                            alpine-active="activeStatusTab === '{{ $status->getId() }}'"
                            x-on:click="setStatusActiveTab('{{ $status->getId() }}')"
                        >
                            {{ $status->getTitle() }}
                        </x-filament::tabs.item>
                    @endforeach

                </x-filament::tabs>

                @foreach($statuses as $status)
                    <div
                        x-show="activeStatusTab === '{{ $status->getId() }}'"
                        x-ref="sortable-{{ $status->getId() }}"
                        data-status-id="{{ $status->getId() }}"
                        wire:key="sortable-{{ $status->getId() }}"
                        class="flex flex-col gap-5">
                        @foreach($records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId()) as $record)
                            @include('filament-kanban::pages.partials.record-list')
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else

            <div class="w-full flex flex-col gap-3">
                <div class="w-full flex flex-col gap-5">
                    @foreach($statuses as $status)
                        <div class="w-full flex flex-col gap-5 @if(!$loop->last) pb-10 mb-5 border-b border-gray-300 dark:border-gray-700 @endif">
                            @include('filament-kanban::pages.partials.status', ['fullWidth' => true])

                            <div
                                x-ref="sortable-{{ $status->getId() }}"
                                data-status-id="{{ $status->getId() }}"
                                wire:key="sortable-{{ $status->getId() }}"
                                class="flex flex-col gap-5">
                                @foreach($records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId()) as $record)
                                    @include('filament-kanban::pages.partials.record-list')
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        @endif

    @endif

</div>
