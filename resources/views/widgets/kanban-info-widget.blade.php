<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section style="background: rgb(254,251,222); background: linear-gradient(90deg, rgba(254,251,222,1) 0%, rgba(255,220,252,1) 100%);">
        <div class="flex items-center gap-x-3">
            <div class="flex-1">
                <a
                    href="https://filament-kanban-docs.heloufir.dev"
                    rel="noopener noreferrer"
                    target="_blank"
                    class="font-bold italic"
                >
                    Filament Kanban
                </a>

                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    v1.4.13
                    <br>
                    <a href="https://filament-kanban-docs.heloufir.dev/#/releases?id=releases" target="_blank"
                       class="hover:underline">Releases Notes</a>
                </p>
            </div>

            <div class="flex flex-col items-end gap-y-1">
                <x-filament::link
                    color="gray"
                    href="https://filament-kanban-docs.heloufir.dev"
                    icon="heroicon-m-book-open"
                    icon-alias="panels::widgets.filament-info.open-documentation-button"
                    rel="noopener noreferrer"
                    target="_blank"

                >
                    Documentation
                </x-filament::link>

                <x-filament::link
                    color="gray"
                    href="https://filament-kanban.heloufir.dev/"
                    icon-alias="panels::widgets.filament-info.open-github-button"
                    rel="noopener noreferrer"
                    target="_blank"

                >
                    <x-slot name="icon">
                        <svg class="bi bi-laptop" fill="currentColor" height="16" viewBox="0 0 16 16" width="16"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                        </svg>
                    </x-slot>

                    Online Demo
                </x-filament::link>

                <x-filament::link
                    color="gray"
                    href="https://checkout.anystack.sh/filament-kanban"
                    icon-alias="panels::widgets.filament-info.open-github-button"
                    rel="noopener noreferrer"
                    target="_blank"

                >
                    <x-slot name="icon">
                        <svg viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><circle
                                cx="89" cy="101" fill="none" r="8" stroke="#ffffff" stroke-linecap="round"
                                stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"
                                class="stroke-00aeef"></circle>
                            <circle cx="49" cy="101" fill="none" r="8" stroke="#ffffff" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"
                                    class="stroke-00aeef"></circle>
                            <path
                                d="M29 33h83.08c2.807 0 4.741 2.816 3.733 5.436L99.877 79.872A8 8 0 0 1 92.41 85H45.608a8 8 0 0 1-7.856-6.49L29 33zM28.946 33.01l-1.517-7.58A8 8 0 0 0 19.585 19h-7.241M89.904 45h3M32 45h48.904"
                                fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-miterlimit="10" stroke-width="4" class="stroke-00aeef"></path></svg>
                    </x-slot>

                    Purchase the plugin
                </x-filament::link>
            </div>
        </div>
    </x-filament::section>
    <div class="w-full">
        <br>
        <img src="{{ asset('filament-kanban.png') }}" style="border-radius: 10px; box-shadow: 1px 1px 3px #cecece;" />
    </div>
</x-filament-widgets::widget>
