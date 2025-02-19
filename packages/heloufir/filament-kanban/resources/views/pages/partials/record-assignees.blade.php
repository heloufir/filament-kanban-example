@php($recordAssigneesTake = 5)
@php($recordAssignees = $record->getAssignees()->take($recordAssigneesTake)->map(fn (\Heloufir\FilamentKanban\Interfaces\KanbanResourceModel $item) => $item->toResource()))
@foreach($recordAssignees as $recordAssignee)
    <img x-tooltip.raw="{{$recordAssignee->getName()}}" src="{{ $recordAssignee->getAvatar() }}" class="border-2 border-gray-100 dark:border-gray-700 w-10 h-10 -ml-3 rounded-full" title="{{ $recordAssignee->getName() }}" alt="{{ $recordAssignee->getName() }}" />
@endforeach
@if($recordAssignees->count() > $recordAssigneesTake)
    <span class="text-xs ml-2">+{{ $recordAssignees->count() - $recordAssigneesTake }}</span>
@endif
