@props([
    'statuses' => $this->getStatuses()->map(fn (\Heloufir\FilamentKanban\Interfaces\KanbanStatusModel $item) => $item->toStatus()),
    'columnWidth' => $this->getColumnWidth(),
    'query' => $this->getQuery(),
    'records' => $this->getRecords()->map(fn (\Heloufir\FilamentKanban\Interfaces\KanbanRecordModel $item) => $item->toRecord()),
])

<x-filament-panels::page>
    <div class="w-full"
         x-data="kanbanBoard()"
         x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-kanban', package: 'heloufir/filament-kanban'))]"
    >

        <div class="w-full flex flex-row justify-start items-start gap-5 overflow-x-auto pb-5">

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

    </div>

    @push('scripts')
        <script>
            function kanbanBoard() {
                return {
                    init() {
                        this.initSortable();
                    },

                    initSortable() {
                        document.querySelectorAll('[x-ref^="sortable-"]').forEach(el => {
                            Sortable.create(el, {
                                group: 'kanban',
                                animation: 150,
                                ghostClass: 'bg-gray-300',
                                onEnd: event => {
                                    this.updateOrder(event);
                                }
                            });
                        });
                    },

                    updateOrder(event) {

                        const columnStart = +event.from.getAttribute('data-status-id');
                        const columnEnd = +event.to.getAttribute('data-status-id');
                        const item = +event.item.getAttribute('data-id');
                        const oldIndex = +event.oldIndex;
                        const newIndex = +event.newIndex;

                        Livewire.dispatch('kanban.drag', {
                            id: item,
                            statusFrom: columnStart,
                            statusTo: columnEnd,
                            oldSort: oldIndex,
                            newSort: newIndex
                        });
                    }
                }
            }
        </script>
    @endpush

</x-filament-panels::page>
