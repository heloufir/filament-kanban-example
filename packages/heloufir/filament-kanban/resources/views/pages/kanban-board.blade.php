@props([
    'statuses' => $this->getStatuses(),
    'columnWidth' => $this->getColumnWidth(),
    'query' => $this->getQuery(),
    'records' => $this->getRecords(),
])

<x-filament-panels::page>
    <div class="w-full"
         x-data="{}"
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
                            <div
                                class="flex flex-col"
                                style="width: {{ $columnWidth }}; min-width: {{ $columnWidth }};">
                                <div class="w-full flex items-center gap-1 p-3 rounded-lg border dark:border-white/10" style="background-color: {{ $status->getColor() ?? 'white' }};">
                                    @if($status->getIcon())
                                        <x-filament::icon :icon="$status->getIcon()" class="w-4 h-4 text-gray-700" />
                                    @endif
                                    <span class="text-sm font-normal leading-6 text-gray-700">{{ $status->getTitle() }}</span>
                                    <span class="flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-1.5 min-w-[theme(spacing.5)] py-0.5 tracking-tight bg-gray-50 ring-gray-600/10 ml-auto text-gray-700">{{ $records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId())->count() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-fit flex gap-5 overflow-y-auto overflow-x-hidden" style="height: calc(100vh - 300px);">
                        @foreach($statuses as $status)
                            <div
                                class="flex flex-col"
                                style="width: {{ $columnWidth }}; min-width: {{ $columnWidth }};">
                                <div class="w-full flex flex-col gap-5 mt-3">
                                    @foreach($records->filter(fn ($record) => $record->getStatus()->getId() === $status->getId()) as $record)
                                        <div class="w-full text-sm rounded-lg hover:shadow flex flex-col gap-2 bg-white p-3 dark:bg-gray-500/20 border dark:border-white/10">
                                            <span class="text-xs opacity-70">Subtitle</span>
                                            <span>Title</span>
                                            <div class="pl-2 border-l-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias delectus deleniti facilis illo minus molestiae praesentium quae rem rerum velit!</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @endif

        </div>

    </div>

</x-filament-panels::page>
