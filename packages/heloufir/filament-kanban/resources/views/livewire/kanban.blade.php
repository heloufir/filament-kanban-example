<x-filament-panels::page>

    <div class="kanban w-full overflow-x-auto flex flex-row gap-3" @if(config('filament-kanban.kanban-height')) style="height: {{ config('filament-kanban.kanban-height') }}px;" @endif>

        @foreach($this->statuses as $status)
            @php
                $records = $this->recordsByStatus($status['id']);
            @endphp
            <div class="kanban-col overflow-y-auto w-[330px] min-w-[330px] h-full rounded-lg bg-slate-100 border border-gray-200 flex flex-col">

                <div class="kanban-col-title flex flex-row items-center gap-2 sticky top-0 bg-slate-100 p-3">
                    <div class="kanban-col-title-color w-3 h-3 rounded-full border-2" style="border-color: {{ $status['color'] ?? 'gray' }};"></div>
                    <span class="kanban-col-title-status text-sm font-medium text-gray-700">{{ $status['name'] }}</span>
                    <span class="kanban-col-title-badge bg-slate-200 p-0.5 text-xs rounded text-gray-500">{{ sizeof($records) }}</span>
                </div>

                <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3" data-status="{{ $status['id'] }}">

                    @foreach($records as $record)

                        <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="{{ $record['id'] }}">
                            <span class="kanban-cel-ref text-xs text-gray-600">{!! $record['subtitle'] !!}</span>
                            <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">{!! $record['title'] !!}</a>
                        </div>

                    @endforeach

                </div>

            </div>
        @endforeach

    </div>

    @if(!config('filament-kanban.kanban-height'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const kanban = document.querySelector('.kanban');
                if (kanban) {
                    const topPosition = kanban.getBoundingClientRect().top;
                    const distanceToBottom = window.innerHeight - topPosition;
                    const minHeight = 500;
                    const filamentSectionPaddingHeight = '2rem';
                    if (distanceToBottom > minHeight) {
                        kanban.style.height = 'calc(' + distanceToBottom + 'px - ' + filamentSectionPaddingHeight + ')';
                    } else {
                        kanban.style.height = minHeight + 'px';
                    }
                }
            });
        </script>
    @endif

</x-filament-panels::page>
