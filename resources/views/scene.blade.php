<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{ $museum->title }}</title>
    <link rel="stylesheet" href="{{ mix('/css/appPanorama.css') }}">
    <script src="{{ mix('/js/app.js') }}"></script>
    <script type="module">
        let obj = {
            "default": {
                "load": true,
                "author": "easycg",
                "firstScene": "scene-{{ $museum->scenes->sortBy('id')->first()->getKey() }}",
                "sceneFadeDuration": 2000,
                "autoLoad": true,
                "autoRotate": 0,
                // "autoRotateInactivityDelay": 5000,
                // "yaw": 180,
                "previewTitle": "{{ $museum->scenes->sortBy('id')->first()->title }}",
                "showControls": true,
                "showZoomCtrl": false,
                "showFullscreenCtrl": false,
                "compass": false,
                "minPitch": -75
            },

            "scenes": {
                @foreach($museum->scenes->sortBy('id') as $scene)
                "scene-{{ $scene->getKey() }}": {
                    "title": "{{ $scene->title }}",
                    "sceneId": "{{ $scene->getKey() }}",
                    "type": "equirectangular",
                    "panorama": "{{ $scene->panorama }}",
                    "hotSpots": [
                        @foreach(@$scene->hotspots as $hotspot)
                        {
                            "pitch": {{ $hotspot->pitch }},
                            "yaw": {{ $hotspot->yaw }},
                            "type": "{{ $hotspot->type }}",
                            "text": "{{ $hotspot->title }}",
                            @if($hotspot->type === 'scene')
                            "sceneId": "scene-{{ $hotspot->pointer_target }}",
                            @endif
                            @if($hotspot->type === 'info')
                            "clickHandlerFunc": function () {
                                // const mediaWindow = document.getElementById('panorama');
{{--                                mediaWindow.insertAdjacentHTML('afterbegin', `{{ view('document', ['document' => $hotspot->document]) }}`);--}}

                                const infoWindow = document.getElementById('{{ $hotspot->document->getKey() }}');

                                infoWindow.style.display = 'flex';

                                if(currentInfo.indexOf({{ $hotspot->document->getKey() }}) === -1) {
                                    currentInfo.push({{ $hotspot->document->getKey() }});
                                }

                                @if($hotspot->audio !== null)
                                function audioPlay () {
                                    new GreenAudioPlayer('.media-description-custom-audio')
                                }
                                audioPlay();
                                @endif
                            },
                            @endif
                        },
                        @endforeach
                    ]
                },
                @endforeach
            }
        }
        if (/Mobile/ig.test(navigator.userAgent)) {
            obj.default.hfov = 80;
        } else {
            obj.default.hfov = 120;
        }
        export let viewer = pannellum.viewer('panorama', obj);

        // Отслеживание смены сцены и смена радио
        viewer.on('scenechange', function(ev) {
            const hotSpot = document.getElementById(ev);
            hotSpot.firstElementChild.checked = true;
            const group = 'spot-'+hotSpot.firstElementChild.dataset.group;
            let hallSpot = document.getElementById(group);
            hallSpot.checked = true;
            let map = document.querySelector('.map');
            if (!map.classList.contains('map-after-scenechange')) {
                map.classList.add('map-after-scenechange');
                map.classList.remove('map-after-scenechange');
            }
            if (map.classList.contains(('map-toggle-on'))) {
                map.classList.toggle('map-toggle-off');
            }
        });

        viewer.on('load', function() {
            let map = document.querySelector('.map');
            map.classList.remove('map-toggle-off');
            map.classList.remove('map-toggle-on');
        })

        /**
         * Функция закрытия описания хотспота
         * @param { String } id Id раскрывающегося описания
         */

        window.cross = function cross(id) {
            let media1 = document.getElementById(id);
            media1.style.display = 'none';
            if (currentInfo.indexOf(id) !== -1) {
                currentInfo.push(id)
            }
        }

        function keysUp() {
            document.getElementById('pan-up').addEventListener('click', function(e) {
                viewer.setPitch(viewer.getPitch() + 10);
            });
            document.getElementById('pan-down').addEventListener('click', function(e) {
                viewer.setPitch(viewer.getPitch() - 10);
            });
            document.getElementById('pan-left').addEventListener('click', function(e) {
                viewer.setYaw(viewer.getYaw() - 10);
            });
            document.getElementById('pan-right').addEventListener('click', function(e) {
                viewer.setYaw(viewer.getYaw() + 10);
            });
            document.getElementById('zoom-in').addEventListener('click', function(e) {
                viewer.setHfov(viewer.getHfov() - 10);
            });
            document.getElementById('zoom-out').addEventListener('click', function(e) {
                viewer.setHfov(viewer.getHfov() + 10);
            });
            document.getElementById('fullscreen').addEventListener('click', function(e) {
                viewer.toggleFullscreen();
            });
        }
        keysUp();

        let radioHotSpots = document.querySelectorAll('.point');
        // Перемещение по радио-кнопкам
        radioHotSpots.forEach(point => {
            point.addEventListener('click', (event) => {
                const target = event.currentTarget;
                viewer.loadScene(target.id);
            });
        });

        /**
         * Функция скрытия и показа панели управления медиа
         */

        function toggleBar() {
            let buttons = document.querySelector(".visible");
            buttons.classList.toggle('ctrl-toggle-off');
            buttons.classList.toggle('ctrl-toggle-on');
        }

        let toggleButton = document.getElementById('toggle-bar');
        toggleButton.addEventListener('click', () => {
            toggleBar();
            toggleButton.classList.toggle("toggle-rotate");
        });

        const radioHalls = document.querySelectorAll('.option');
        // Перемещение по радио-кнопкам
        radioHalls.forEach(hall => {
            hall.addEventListener('click', (event) => {
                const scene = 'scene-'+event.currentTarget.dataset.scene;
                viewer.loadScene(scene);
            });
        });



        const radioPrev = document.querySelector('.label-open-list');
        radioPrev.addEventListener('click', (ev) => {
            ev.preventDefault();
            let list = ev.target.closest('label.label-open-list');
            let listArr = list.lastElementChild.children;
            for (let i = 0; i < listArr.length; i++) {
                if (listArr[i].classList.contains('option')) {
                    listArr[i].classList.toggle('open-halls');
                }
            }
        })
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/greghub/green-audio-player/dist/css/green-audio-player.min.css">
    <script src="https://cdn.jsdelivr.net/gh/greghub/green-audio-player/dist/js/green-audio-player.min.js"></script>
</head>

<body>

<div id="panorama">
    @foreach(\App\Models\Document::all() as $document)
        @include('document', ['document' => $document])
    @endforeach
    <a href="/">
        <div class="map-description-text-pc">
            <h2>Музей разведчика Н.И.Кузнецова</h2>
            <h3>{{ $museum->title }}</h3>
        </div>
    </a>
        <div id="controls">
            <div class="ctrl toggle-bar" id="toggle-bar">
                <img src="{{ Storage::url('assets/Polygon.svg') }}" alt="arrowdown">
            </div>
            <div class="visible ctrl-toggle-on">
                <div class="ctrl ctrl-nav" id="pan-up">
                    <svg width="25" height="20" viewBox="0 0 80 120" fill="none" style="transform: rotate(180deg); vertical-align: top" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.6199 117.463C35.5725 119.416 38.7383 119.416 40.6909 117.463L72.5107 85.6431C74.4633 83.6905 74.4633 80.5246 72.5107 78.572C70.5581 76.6194 67.3922 76.6194 65.4396 78.572L37.1554 106.856L8.87109 78.5721C6.91846 76.6195 3.75264 76.6195 1.80002 78.5721C-0.152601 80.5247 -0.152597 83.6906 1.80003 85.6432L33.6199 117.463ZM32.1553 0.972662L32.1554 113.927L42.1554 113.927L42.1553 0.972651L32.1553 0.972662Z" fill="white"/>
                    </svg>
                </div>
                <div class="ctrl ctrl-nav" id="pan-down">
                    <svg width="25" height="20" viewBox="0 0 80 120" fill="none" style="vertical-align: top" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.6199 117.463C35.5725 119.416 38.7383 119.416 40.6909 117.463L72.5107 85.6431C74.4633 83.6905 74.4633 80.5246 72.5107 78.572C70.5581 76.6194 67.3922 76.6194 65.4396 78.572L37.1554 106.856L8.87109 78.5721C6.91846 76.6195 3.75264 76.6195 1.80002 78.5721C-0.152601 80.5247 -0.152597 83.6906 1.80003 85.6432L33.6199 117.463ZM32.1553 0.972662L32.1554 113.927L42.1554 113.927L42.1553 0.972651L32.1553 0.972662Z" fill="white"/>
                    </svg>
                </div>
                <div class="ctrl ctrl-nav" id="pan-left">
                    <svg width="25" height="20" viewBox="0 0 80 120" fill="none" style="transform: rotate(90deg); vertical-align: top" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.6199 117.463C35.5725 119.416 38.7383 119.416 40.6909 117.463L72.5107 85.6431C74.4633 83.6905 74.4633 80.5246 72.5107 78.572C70.5581 76.6194 67.3922 76.6194 65.4396 78.572L37.1554 106.856L8.87109 78.5721C6.91846 76.6195 3.75264 76.6195 1.80002 78.5721C-0.152601 80.5247 -0.152597 83.6906 1.80003 85.6432L33.6199 117.463ZM32.1553 0.972662L32.1554 113.927L42.1554 113.927L42.1553 0.972651L32.1553 0.972662Z" fill="white"/>
                    </svg>
                </div>
                <div class="ctrl ctrl-nav" id="pan-right">
                    <svg width="25" height="20" viewBox="0 0 80 120" fill="none" style="transform: rotate(-90deg); vertical-align: top" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.6199 117.463C35.5725 119.416 38.7383 119.416 40.6909 117.463L72.5107 85.6431C74.4633 83.6905 74.4633 80.5246 72.5107 78.572C70.5581 76.6194 67.3922 76.6194 65.4396 78.572L37.1554 106.856L8.87109 78.5721C6.91846 76.6195 3.75264 76.6195 1.80002 78.5721C-0.152601 80.5247 -0.152597 83.6906 1.80003 85.6432L33.6199 117.463ZM32.1553 0.972662L32.1554 113.927L42.1554 113.927L42.1553 0.972651L32.1553 0.972662Z" fill="white"/>
                    </svg>
                </div>
                <div class="ctrl ctrl-nav" id="zoom-in">
                    <svg width="20" height="20" viewBox="0 0 110 110" fill="none" style="vertical-align: top;" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.355469 57.4502L113.31 57.4501" stroke="white" stroke-width="10"/>
                        <path d="M56.833 113.927L56.833 0.972008" stroke="white" stroke-width="10"/>
                    </svg>
                </div>
                <div class="ctrl ctrl-nav" id="zoom-out">
                    <svg width="20" height="20" viewBox="0 0 110 110" fill="none" style="vertical-align: top;" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.355469 57.4502L113.31 57.4501" stroke="white" stroke-width="10"/>
                    </svg>
                </div>
                <div class="ctrl ctrl-nav" id="fullscreen">
                    <svg width="20" height="20" viewBox="0 0 140 140" fill="none" style="vertical-align: top;" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.2354 110.386C25.2354 113.147 27.4739 115.386 30.2354 115.386L75.2354 115.386C77.9968 115.386 80.2354 113.147 80.2354 110.386C80.2354 107.624 77.9968 105.386 75.2354 105.386L35.2354 105.386L35.2353 65.3857C35.2353 62.6243 32.9968 60.3857 30.2353 60.3857C27.4739 60.3857 25.2353 62.6243 25.2353 65.3857L25.2354 110.386ZM115.106 30.5147C115.106 27.7532 112.868 25.5147 110.106 25.5147L65.1064 25.5147C62.345 25.5147 60.1064 27.7532 60.1064 30.5147C60.1064 33.2761 62.345 35.5147 65.1064 35.5147L105.106 35.5147L105.106 75.5147C105.106 78.2761 107.345 80.5147 110.106 80.5147C112.868 80.5147 115.106 78.2761 115.106 75.5147L115.106 30.5147ZM33.7709 113.921L113.642 34.0502L106.571 26.9791L26.6998 106.85L33.7709 113.921Z" fill="white"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="map-wrapper">
            <button class="map-toggle" onclick="toggleMap()">
                <img src="{{ Storage::url('assets/map.svg') }}" alt="map" height="15px">
            </button>
            <div class="pnlm-orientation-button pnlm-orientation-button-inactive pnlm-sprite pnlm-controls pnlm-control orientation-button"></div>
            <div class="map">
                <a href="/" style="text-decoration: none">
                    <div class="map-description-text">
                        <h2>Музей разведчика Н.И.Кузнецова</h2>
                        <h3>г. Талица</h3>
                    </div>
                </a>
                <label for="open-list" class="label-open-list">
                    <input type="checkbox" name="open-list" id="open-list">
                    <div class="select" id="select-list" tabindex="1">
                        @foreach($museum->scenes->map(fn(\App\Models\Scene $scene) => $scene->group)->unique()->all() as $group)
                            <input class="selectopt" name="test" type="radio" id="spot-{{ $group->getKey() }}" data-scene="{{ $group->scenes->first()->getKey() }}" @once checked @endonce>
                            <label for="{{ $group->getKey() }}-spot" id="{{ $group->getKey() }}-hall" data-scene="{{ $group->scenes->first()->getKey() }}" class="option">{{ $group->title }}</label>
                        @endforeach
                    </div>
                </label>
                <img src="{{ $museum->map }}" alt="map" class="map-pic">
                @foreach($museum->scenes as $scene)
                    <div class="point" id="scene-{{ $scene->getKey() }}" style="position: absolute; top: {{ $scene->map_y+12 }}%; left: {{ $scene->map_x }}%">
                        <input @once checked @endonce type="radio" name="radio-group" data-group="{{ $scene->group->getKey() }}" id="radio-{{ $scene->getKey() }}">
                        <label class="point-label" for="radio-{{ $scene->getKey() }}"></label>
                    </div>
                @endforeach
            </div>
        </div>

</div>
<script>
    const map = document.querySelector('.map');

    window.currentInfo = [];
    function toggleMap () {
        map.classList.toggle('map-toggle-on');
    }
    function toggleText(id) {
        const mediaText = document.getElementById(id);
        mediaText.classList.toggle('media-description-text-padding');
        const mediaToggler = document.getElementById('toggler-text');
        mediaToggler.classList.toggle('toggler-text-rotate');
    }
    function showMoreInfo(id) {
        document.getElementById(id).style.display = 'flex';
        if(currentInfo.indexOf(id) === -1) {
            currentInfo.push(id);
        }
    }
</script>
</body>

</html>
