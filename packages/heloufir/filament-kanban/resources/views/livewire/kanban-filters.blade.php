<div class="w-full" style="z-index: 2;">
    <div class="grid divide-y divide-neutral-200 w-full">
        <div>
            <details class="group bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-800 rounded-lg">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none p-3 text-gray-700 dark:text-gray-300">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-adjustments-vertical class="w-5"></x-heroicon-o-adjustments-vertical>
                        @lang('filament-kanban::filament-kanban.filters.title')
                    </div>
                    <div class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                             stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                             width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </div>
                </summary>
                <div class="group-open:animate-fadeIn border-t border-gray-100 dark:border-gray-800 p-3">
                    <form wire:submit="submitFilter">
                        {{ $this->filterForm }}

                        <div class="w-full flex items-center gap-3 mt-6">
                            <x-filament::button type="submit" class="mt-6" icon="heroicon-m-funnel" size="sm">
                                @lang('filament-kanban::filament-kanban.filters.buttons.submit')
                            </x-filament::button>
                            <x-filament::button type="button" class="mt-6" icon="heroicon-m-arrow-path" size="sm" wire:click="resetFilter" color="gray">
                                @lang('filament-kanban::filament-kanban.filters.buttons.reset')
                            </x-filament::button>
                        </div>
                    </form>
                </p>
            </details>
        </div>
    </div>
</div>
