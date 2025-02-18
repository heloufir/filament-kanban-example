@if($record->isEditable() || $record->isDeletable() || $record->isViewable())
    @php($actions = [])
    @php($options = ['record' => $record->getModel(), 'recordTitle' => $record->getTitle()])
    @if($record->isViewable())
        @php($actions[] = ($this->viewAction)($options))
    @endif
    @if($record->isEditable())
        @php($actions[] = ($this->editAction)($options))
    @endif
    @if($record->isDeletable())
        @php($actions[] = ($this->deleteAction)($options))
    @endif
    <x-filament-actions::group
        label="Actions"
        icon="heroicon-m-ellipsis-vertical"
        color="gray"
        size="md"
        :tooltip="__('filament-kanban::filament-kanban.actions.more')"
        dropdown-placement="bottom-start"
        :actions="$actions" />
@endif
