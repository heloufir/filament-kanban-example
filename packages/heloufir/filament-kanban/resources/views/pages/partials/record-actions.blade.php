@if($record->isEditable() || $record->isDeletable() || $record->isViewable())
    @php($actions = [])
    @php($options = ['record' => $record->getModel(), 'recordTitle' => $record->getTitle()])
    @foreach($recordActions as $recordAction)
        @if(
            ($recordAction->getName() == 'view' && $record->isViewable())
            || ($recordAction->getName() == 'edit' && $record->isEditable())
            || ($recordAction->getName() == 'delete' && $record->isDeletable())
            || (!in_array($recordAction->getName(), ['view', 'edit', 'delete']) && $recordAction->isVisible())
        )
            @php($actions[] = ($recordAction)($options))
        @endif
    @endforeach
    <x-filament-actions::group
        wire:key="record-{{ $record->getId() }}-actions"
        label="Actions"
        icon="heroicon-m-ellipsis-vertical"
        color="gray"
        size="md"
        :tooltip="__('filament-kanban::filament-kanban.actions.more')"
        dropdown-placement="bottom-start"
        :actions="$actions"/>
@endif
