import Sortable from "sortablejs";

document.addEventListener('livewire:initialized', function () {
    const elements = document.querySelectorAll('.kanban-col-container');
    [].forEach.call(elements, (el) => {
        const sortable = Sortable.create(el, {
            group: {
                name: 'status-' + el.dataset.status,
                put: true,
                pull: true
            },
            sort: true,
            animation: 200,
            filter: ".disable-sortable",

            onEnd: function (evt) {
                const itemEl = evt.item;  // dragged HTMLElement
                const targetList = evt.to;    // target list
                const previousList = evt.from;  // previous list
                const oldIndex = evt.oldIndex;  // element's old index within old parent
                const newIndex = evt.newIndex;  // element's new index within new parent
                if (previousList.dataset.status !== targetList.dataset.status || oldIndex !== newIndex) {
                    if (previousList !== targetList) {
                        Livewire.dispatch('filament-kanban.record-drag', {
                            record: +itemEl.dataset.id,
                            source: +previousList.dataset.status,
                            target: +targetList.dataset.status,
                            oldIndex: oldIndex,
                            newIndex: newIndex
                        });
                    } else {
                        Livewire.dispatch('filament-kanban.record-sort', {
                            record: +itemEl.dataset.id,
                            source: +previousList.dataset.status,
                            target: +targetList.dataset.status,
                            oldIndex: oldIndex,
                            newIndex: newIndex
                        });
                    }
                }
            },
        });
    })
})
