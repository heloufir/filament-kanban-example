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
                    const newOrder = getNewOrderOfNewStatusRecord(itemEl).concat(sortable.toArray()).unique();
                    console.log(newOrder);
                    const data = {
                        record: +itemEl.dataset.id,
                        source: +previousList.dataset.status,
                        target: +targetList.dataset.status,
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

/**
 * Get records order in a status column based on a record element
 * @param itemEl
 * @returns {*[]}
 */
function getNewOrderOfNewStatusRecord(itemEl) {
    const parent = itemEl.parentElement;
    const records = parent.querySelectorAll('.kanban-cel');
    const newOrder = [];
    records.forEach((record) => {
        newOrder.push(record.dataset.id);
    });
    return newOrder;
}

/**
 * Remove duplicates from an array
 * @returns {*[]}
 */
Array.prototype.unique = function() {
    var a = this.concat();
    for(var i=0; i<a.length; ++i) {
        for(var j=i+1; j<a.length; ++j) {
            if(a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
};
