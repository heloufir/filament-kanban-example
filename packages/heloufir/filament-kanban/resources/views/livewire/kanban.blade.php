<x-filament-panels::page>
    <div
        class="flex flex-col gap-10 relative"
        x-data="{collapsedColumns: @json(collect($this->statuses)->filter(fn ($item) => $item['collapsed'] ?? false)->pluck('id')->toArray())}"
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-kanban', package: 'heloufir/filament-kanban'))]"
    >

        @include('filament-kanban::livewire.partials.loading')

        @if($this->showFilters)
            @include('filament-kanban::livewire.kanban-filters')
        @endif

        @if(!$this->disableKanbanListView)
            @include('filament-kanban::livewire.kanban-views-buttons')
        @endif

        @if($this->selectedKanbanView == 'kanban')
            <div class="kanban w-full overflow-x-hidden hover:overflow-x-auto flex flex-row gap-3"
                 @if(config('filament-kanban.kanban-height')) style="height: {{ config('filament-kanban.kanban-height') }}px;" @endif>

                @foreach($this->statuses as $status)
                    @php
                        $records = $this->recordsByStatus($status['id']);
                    @endphp

                    @include('filament-kanban::livewire.partials.column')
                @endforeach

            </div>
        @elseif($this->selectedKanbanView == 'list')
            <div class="kanban-list w-full flex flex-col">

                <div class="w-full flex flex-row justify-start items-center gap-2 mb-2">
                    <div class="w-2/4">
                        <span class="kanban-section-divider text-sm font-medium text-gray-700 dark:text-gray-300">
                            @lang('filament-kanban::filament-kanban.sections.task')
                        </span>
                    </div>
                    <div class="w-1/4">
                        <span class="kanban-section-divider text-sm font-medium text-gray-700 dark:text-gray-300">
                            @lang('filament-kanban::filament-kanban.sections.assignees')
                        </span>
                    </div>
                    <div class="w-1/4">
                        <span class="kanban-section-divider text-sm font-medium text-gray-700 dark:text-gray-300">
                            @lang('filament-kanban::filament-kanban.sections.due-date')
                        </span>
                    </div>
                </div>
                @foreach($this->statuses as $status)
                    @php
                        $records = $this->recordsByStatus($status['id']);
                    @endphp

                    @include('filament-kanban::livewire.partials.sections')
                @endforeach

            </div>
        @endif

    </div>

    <x-filament::modal id="filament-kanban.record-modal"
                       :slide-over="config('filament-kanban.record-modal.position') === 'slide-over'" sticky-header
                       width="{{ config('filament-kanban.record-modal.size') }}">
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <span>
                    {{ $modalMode === 'update' ? ($record['title'] ?? '') : __('filament-kanban::filament-kanban.modal.create') }}
                </span>
                @if($modalMode === 'update')
                    &nbsp;&nbsp;<span class="btn">
                        <x-filament::icon-button
                            @click="$wire.dispatch('filament-kanban.share-record', {id: '{{ $record['id'] }}'})"
                            icon="heroicon-m-link"
                            size="xs"
                            color="info"
                            label="{{ __('filament-kanban::filament-kanban.record.share.button') }}"
                        />
                    </span>
                @endif
            </div>
        </x-slot>

        <form wire:submit="submitRecord">
            {{ $this->form }}

            <div class="flex flex-row justify-start items-center gap-3 flex-wrap w-full mt-6">
                <x-filament::button type="submit">
                    @lang('filament-kanban::filament-kanban.modal.submit')
                </x-filament::button>

                @foreach($this->getRecordModalActions() as $recordModalAction)
                    {!! $recordModalAction->render() !!}
                @endforeach
            </div>
        </form>
    </x-filament::modal>

    <x-filament::modal id="filament-kanban.delete-modal" sticky-header width="lg" icon="heroicon-o-exclamation-triangle"
                       icon-color="danger">
        <x-slot name="heading">
            @lang('filament-kanban::filament-kanban.modal.delete-confirmation.heading')
        </x-slot>
        <x-slot name="description">
            @lang('filament-kanban::filament-kanban.modal.delete-confirmation.description')
        </x-slot>

        <x-slot name="footerActions">
            <x-filament::button type="button" wire:click="confirmRecordDeletion" color="danger">
                @lang('filament-kanban::filament-kanban.modal.delete-confirmation.actions.confirm')
            </x-filament::button>
            <x-filament::button type="button" wire:click="cancelRecordDeletion" color="gray">
                @lang('filament-kanban::filament-kanban.modal.delete-confirmation.actions.cancel')
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

    @if(!config('filament-kanban.kanban-height'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.kanbanUtilities.kanbanResizeHeight();

                document.kanbanUtilities.selectedRecord();
            });

            document.addEventListener('livewire:init', () => {
                Livewire.on('filament-kanban.kanban-view-selected', (event) => {
                    setTimeout(() => document.kanbanUtilities.kanbanResizeHeight(), 100);
                });

                Livewire.on('filament-kanban.share-record', (event) => {
                    const id = event.id;
                    const url = "{{ url()->current() }}?selected=" + id;

                    // Handle copy using clipboard API since older one was not working consistently in modal
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(url).then(() => {
                            new FilamentNotification()
                                .title('{{ __('filament-kanban::filament-kanban.record.share.notification.title') }}')
                                .success()
                                .send();
                        }).catch(err => {
                            console.error('Failed to copy: ', err);
                        });
                    } else {
                        // Fallback using older method
                        const textarea = document.createElement("textarea");
                        textarea.value = url;
                        textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge
                        document.body.appendChild(textarea);
                        textarea.focus();
                        textarea.select();
                        try {
                            document.execCommand("copy");
                            new FilamentNotification()
                                .title('{{ __('filament-kanban::filament-kanban.record.share.notification.title') }}')
                                .success()
                                .send();
                        } catch (err) {
                            console.error('Fallback: Failed to copy: ', err);
                        }
                        document.body.removeChild(textarea);
                    }
                });
            });

            function toggleElementInArray(array, element) {
                const index = array.indexOf(element);
                if (index !== -1) {
                    array.splice(index, 1);
                } else {
                    array.push(element);
                }
            }
        </script>
    @endif

</x-filament-panels::page>
