import 'pannellum'

export default class extends window.Controller {
    static get targets() {
        return [
            'pitch',
            'yaw',
            'scene'
        ];
    }

    connect() {
        setTimeout(() => {
            const container = this.data.get('name');
            const panorama = this.data.get('panorama');

            const scene = {
                'title': 'Редактор сцены',
                'sceneId': 'editor',
                'type': 'equirectangular',
                'compass': false,
                'panorama': this.data.get('panorama'),
            };

            const viewer = pannellum.viewer(container, {
                'type': 'equirectangular',
                'panorama': panorama,
                'autoLoad': true,
                'firstScene': 'editor',
                'scenes': {'editor': scene}
            });

            for (let hotspot of this.hotspots) {
                hotspot['clickHandlerFunc'] = function () {
                    window.location = hotspot['route'];
                };
                viewer.addHotSpot(hotspot, viewer.getScene())
            }

            const viewerElement = document.getElementById(container);

            viewerElement.addEventListener('contextmenu', (ev) => this.openModal(ev, viewer));
        }, 200)
    }

    openModal(ev, viewer) {
        [
            this.pitchTarget.value,
            this.yawTarget.value
        ] = viewer.mouseEventToCoords(ev);

        const form = this.modal.firstElementChild.firstElementChild;

        this.application.getControllerForElementAndIdentifier(this.modal, 'modal')
            .open({
                title: this.data.get('title') || this.modal.dataset.modalTitle,
                submit: this.data.get('action'),
                params: this.data.get('params', '[]'),
            });

        form.addEventListener('submit', () => {
            for (const target of this.constructor.targets) {
                form.append(this[`${target}Target`].cloneNode());
            }
        })
    }
    get modal() {
        return document.getElementById(`screen-modal-${this.data.get('modal')}`);
    }

    get hotspots() {
        return JSON.parse(this.data.get('hotspots'));
    }


}
