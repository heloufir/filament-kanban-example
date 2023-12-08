<x-filament-panels::page>

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

                    navigator.clipboard.writeText("{{ url()->current() }}?selected=" + id);

                    new FilamentNotification()
                        .title('{{ __('filament-kanban::filament-kanban.record.share.notification.title') }}')
                        .success()
                        .send()
                });
            });
        </script>
    @endif

</x-filament-panels::page>
