@props([
    'statuses' => $this->getStatuses()->map(fn (\Heloufir\FilamentKanban\Interfaces\KanbanStatusModel $item) => $item->toStatus()),
    'columnWidth' => $this->getColumnWidth(),
    'query' => $this->getQuery(),
    'records' => $this->getRecords()->map(fn (\Heloufir\FilamentKanban\Interfaces\KanbanRecordModel $item) => $item->toRecord()),
    'enabledViews' => $this->enabledViews,
    'currentView' => $this->currentView,
    'showViewTabs' => $this->showViewTabs,
    'persistCurrentTab' => $this->persistCurrentTab,
    'showStatusesAsTabs' => $this->showStatusesAsTabs,
    'table' => $this->table,
])

<x-filament-panels::page>

    <div class="w-full"
         x-data="kanbanBoard()"
         x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-kanban', package: 'heloufir/filament-kanban'))]"
    >

        {{--VIEW TABS--}}
        @if($showViewTabs)
            <x-filament::tabs class="mb-5">

                @foreach($enabledViews as $enabledView)
                    <x-filament::tabs.item
                        :icon="$enabledView->getIcon()"
                        :icon-position="$enabledView->getIconPosition()"
                        alpine-active="activeTab === '{{ $enabledView }}'"
                        x-on:click="setActiveTab('{{ $enabledView }}')"
                    >
                        {{ $enabledView->getLabel() }}
                    </x-filament::tabs.item>
                @endforeach

            </x-filament::tabs>
        @endif

        {{--BOARD VIEW--}}
        @include('filament-kanban::pages.partials.board')

        {{--LIST VIEW--}}
        @include('filament-kanban::pages.partials.list')

        {{--TABLE VIEW--}}
        @include('filament-kanban::pages.partials.table')

    </div>

    @push('scripts')
        <script>
            function kanbanBoard() {
                return {
                    activeTab: '{{ $currentView }}',
                    activeStatusTab: '{{ $statuses->first()?->getId() }}',

                    init() {
                        this.initSortable();
                    },

                    setActiveTab(tab) {
                        this.activeTab = tab;
                        Livewire.dispatch('kanban.change-view', { active: tab });
                    },

                    setStatusActiveTab(status) {
                        this.activeStatusTab = status;
                    },

                    initSortable() {
                        document.querySelectorAll('[x-ref^="sortable-"]').forEach(el => {
                            Sortable.create(el, {
                                group: 'kanban',
                                animation: 200,
                                filter: ".no-drag",
                                ghostClass: 'bg-gray-300',
                                onEnd: event => {
                                    this.updateOrder(event);
                                }
                            });
                        });
                    },

                    updateOrder(event) {

                        const columnStart = event.from.getAttribute('data-status-id');
                        const columnEnd = event.to.getAttribute('data-status-id');
                        const item = event.item.getAttribute('data-id');
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
