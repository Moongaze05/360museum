export default class extends window.Controller {
    static get targets() {
        return [
            'map',
            'targetX',
            'targetY',
            'parent_id'
        ]
    }

    connect() {
        this.mapTarget.addEventListener('mousedown', (ev) => {
            if (ev.target !== this.mapTarget.querySelector('#map-image')) {
                return;
            }
            this.targetXTarget.value = (ev.offsetX/this.mapTarget.offsetWidth)*100;
            this.targetYTarget.value = (ev.offsetY/this.mapTarget.offsetHeight)*100;
            this.openModal();
        });

        document.querySelectorAll('.mapper-map__point').forEach(el => {
            el.addEventListener('mousedown', () => {
                window.location = `/admin/document/${el.id}`;
            })
        })
    }

    openModal() {
        const form = this.modal.firstElementChild.firstElementChild;

        this.application.getControllerForElementAndIdentifier(this.modal, 'modal')
            .open({
                title: this.data.get('title') || this.modal.dataset.modalTitle,
                submit: this.data.get('action'),
                params: this.data.get('params', '[]'),
            });

        form.addEventListener('submit', (ev) => {
            for (const target of this.constructor.targets) {
                if (target === 'map') {
                    continue;
                }
                form.append(this[`${target}Target`].cloneNode());
            }
        });
    }

    get modal() {
        return document.getElementById(`screen-modal-${this.data.get('modal')}`);
    }
}
