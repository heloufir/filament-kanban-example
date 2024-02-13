<x-filament-panels::page>
    <div
        class="flex flex-col gap-10"
        x-data="{collapsedColumns: @json(collect($this->statuses)->filter(fn ($item) => $item['collapsed'] ?? false)->pluck('id')->toArray())}"
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-kanban', package: 'heloufir/filament-kanban'))]"
    >

        @if($this->showFilters)
            @include('filament-kanban::livewire.kanban-filters')
        @endif

        <div class="kanban w-full overflow-x-hidden hover:overflow-x-auto flex flex-row gap-3"
             @if(config('filament-kanban.kanban-height')) style="height: {{ config('filament-kanban.kanban-height') }}px;" @endif>

            @foreach($this->statuses as $status)
                @php
                    $records = $this->recordsByStatus($status['id']);
                @endphp

                @include('filament-kanban::livewire.partials.column')
            @endforeach

        </div>

    </div>

    <x-filament::modal id="filament-kanban.record-modal"
                       :slide-over="config('filament-kanban.record-modal.position') === 'slide-over'" sticky-header
                       width="{{ config('filament-kanban.record-modal.size') }}">
        <x-slot name="heading">
            {{ $modalMode === 'update' ? ($record['title'] ?? '') : __('filament-kanban::filament-kanban.modal.create') }}
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
                Livewire.on('filament-kanban.share-record', (event) => {
                    const id = event.id;
                    const url = "{{ url()->current() }}?selected=" + id;

                    // Handle copy
                    const textarea = document.createElement("textarea");
                    textarea.textContent = url;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand("copy");
                    document.body.removeChild(textarea);

                    new FilamentNotification()
                        .title('{{ __('filament-kanban::filament-kanban.record.share.notification.title') }}')
                        .success()
                        .send()
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
