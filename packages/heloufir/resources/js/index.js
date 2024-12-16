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
                const componentId = document.querySelector('.fi-page').getAttribute('wire:id');
                if (Livewire.find(componentId).get('loadingActivated')) {
                    Livewire.find(componentId).set('loading', true);
                }
                const itemEl = evt.item;  // dragged HTMLElement
                const targetList = evt.to;    // target list
                const previousList = evt.from;  // previous list
                const oldIndex = evt.oldIndex;  // element's old index within old parent
                const newIndex = evt.newIndex;  // element's new index within new parent
                if (evt.from.dataset.draggable) {
                    const newOrder = document.kanbanUtilities.getNewOrderOfNewStatusRecord(itemEl).concat(sortable.toArray()).filter((value, index, array) => array.indexOf(value) === index).filter(item => item !== "3mu");
                    const data = {
                        record: parseInt(itemEl.dataset.id) === Number(itemEl.dataset.id) ? +itemEl.dataset.id : itemEl.dataset.id,
                        source: parseInt(previousList.dataset.status) === Number(previousList.dataset.status) ? +previousList.dataset.status : previousList.dataset.status,
                        target: parseInt(targetList.dataset.status) === Number(targetList.dataset.status) ? +targetList.dataset.status : targetList.dataset.status,
                        oldIndex: oldIndex,
                        newIndex: newIndex,
                        newOrder: newOrder
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

document.kanbanUtilities = {};

/**
 * Get records order in a status column based on a record element
 * @param itemEl
 * @returns {*[]}
 */
document.kanbanUtilities.getNewOrderOfNewStatusRecord = function(itemEl) {
    const parent = itemEl.parentElement;
    const records = parent.querySelectorAll('.kanban-cel');
    const newOrder = [];
    records.forEach((record) => {
        newOrder.push(record.dataset.id);
    });
    return newOrder;
}

document.kanbanUtilities.kanbanResizeHeight = function () {
    const kanban = document.querySelector('.kanban');
    if (kanban) {
        const topPosition = kanban.getBoundingClientRect().top;
        const distanceToBottom = window.innerHeight - topPosition;
        const minHeight = 500;
        const filamentSectionPaddingHeight = '2rem';
        let height = '';
        if (distanceToBottom > minHeight) {
            height = 'calc(' + distanceToBottom + 'px - ' + filamentSectionPaddingHeight + ')';
        } else {
            height = minHeight + 'px';
        }
        const styleElement = document.createElement('style');
        styleElement.textContent = `
                        .kanban {
                            height: ${height};
                        }
                    `;
        document.head.appendChild(styleElement);
    }
}

document.kanbanUtilities.selectedRecord = function () {
    setTimeout(() => {

        const url = new URL(window.location.href);
        const urlParams = url.searchParams;

        if (urlParams.has('selected')) {
            const selected = urlParams.get('selected');
            const recordTitle = document.querySelector('.kanban-cell[data-id="' + selected + '"] .kanban-cell-title');
            if (recordTitle) {
                recordTitle.click();
            }
        }

    }, 300);
}
