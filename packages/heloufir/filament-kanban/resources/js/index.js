import Sortable from "sortablejs";

document.addEventListener('livewire:initialized', function () {
    const elements = document.querySelectorAll('.kanban-col-container');
    [].forEach.call(elements, (el) => {
        const sortable = Sortable.create(el, {
            group: {
                name: 'status-' + el.dataset.status,
                put: el.dataset.draggable === "1",
                pull: el.dataset.draggable === "1"
            },
            sort: true,
            animation: 200,
            filter: ".disable-draggable",

            onEnd: function (evt) {
                const itemEl = evt.item;  // dragged HTMLElement
                const targetList = evt.to;    // target list
                const previousList = evt.from;  // previous list
                const oldIndex = evt.oldIndex;  // element's old index within old parent
                const newIndex = evt.newIndex;  // element's new index within new parent
                if (evt.from.dataset.draggable) {
                    const data = {
                        record: +itemEl.dataset.id,
                        source: +previousList.dataset.status,
                        target: +targetList.dataset.status,
                        oldIndex: oldIndex,
                        newIndex: newIndex,
                        newOrder: sortable.toArray()
                    };
                    let eventName;
                    if (previousList !== targetList) {
                        eventName = 'filament-kanban.record-drag';
                    } else {
                        eventName = 'filament-kanban.record-sort';
                    }
                    Livewire.dispatch(eventName, data);
                }
            },
        });
    });
});
