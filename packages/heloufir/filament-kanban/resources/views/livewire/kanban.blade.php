<div class="kanban w-full h-[550px] overflow-x-auto flex flex-row gap-3">

    <div class="kanban-col overflow-y-auto w-[330px] min-w-[330px] h-full p-3 rounded-lg bg-slate-100 border border-gray-200 flex flex-col gap-3">

        <div class="kanban-col-title flex flex-row items-center gap-2">
            <div class="kanban-col-title-color w-3 h-3 rounded-full border-2" style="border-color: gray;"></div>
            <span class="kanban-col-title-status text-sm font-medium text-gray-700">Draft</span>
            <span class="kanban-col-title-badge bg-slate-200 p-0.5 text-xs rounded text-gray-500">0</span>
        </div>

        <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3" data-status="1">

        </div>

    </div>

    <div class="kanban-col overflow-y-auto w-[330px] min-w-[330px] h-full rounded-lg bg-slate-100 border border-gray-200 flex flex-col">

        <div class="kanban-col-title flex flex-row items-center gap-2 sticky top-0 bg-slate-100 p-3">
            <div class="kanban-col-title-color w-3 h-3 rounded-full border-2" style="border-color: blue;"></div>
            <span class="kanban-col-title-status text-sm font-medium text-gray-700">Submitted</span>
            <span class="kanban-col-title-badge bg-slate-200 p-0.5 text-xs rounded text-gray-500">1</span>
        </div>

        <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3" data-status="2">
            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="1">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 1 Col 2</a>
            </div>
        </div>

    </div>

    <div class="kanban-col overflow-y-auto w-[330px] min-w-[330px] h-full rounded-lg bg-slate-100 border border-gray-200 flex flex-col">

        <div class="kanban-col-title flex flex-row items-center gap-2 sticky top-0 bg-slate-100 p-3">
            <div class="kanban-col-title-color w-3 h-3 rounded-full border-2" style="border-color: orangered;"></div>
            <span class="kanban-col-title-status text-sm font-medium text-gray-700">Changes requested</span>
            <span class="kanban-col-title-badge bg-slate-200 p-0.5 text-xs rounded text-gray-500">4</span>
        </div>

        <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3" data-status="3">
            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="2">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 1 Col 3</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="3">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 2 Col 3</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="4">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 3 Col 3</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="5">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 4 Col 3</a>
            </div>
        </div>

    </div>

    <div class="kanban-col overflow-y-auto w-[330px] min-w-[330px] h-full rounded-lg bg-slate-100 border border-gray-200 flex flex-col">

        <div class="kanban-col-title flex flex-row items-center gap-2 sticky top-0 bg-slate-100 p-3">
            <div class="kanban-col-title-color w-3 h-3 rounded-full border-2" style="border-color: green;"></div>
            <span class="kanban-col-title-status text-sm font-medium text-gray-700">Published</span>
            <span class="kanban-col-title-badge bg-slate-200 p-0.5 text-xs rounded text-gray-500">10</span>
        </div>

        <div class="kanban-col-container w-full h-full px-3 mb-6 flex flex-col gap-3" data-status="4">
            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="6">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 1 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="8">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 2 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="9">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 3 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="10">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 4 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="11">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 5 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="12">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 6 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="13">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 7 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="14">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 8 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="15">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 9 Col 4</a>
            </div>

            <div class="kanban-cel w-full p-3 rounded-lg bg-white border border-gray-200 flex flex-col gap-2 hover:shadow-lg" data-id="7">
                <span class="kanban-cel-ref text-xs text-gray-600">filament-kanban <span class="font-medium">#166</span></span>
                <a href="#" class="kanban-cel-title text-sm text-gray-700 font-medium hover:underline hover:cursor-pointer">Record 10 Col 4</a>
            </div>
        </div>

    </div>

</div>
