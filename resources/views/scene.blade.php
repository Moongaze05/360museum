<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ mix('/js/app.js') }}"></script>
    <style>
        .map {
            background-image: url({{ $museum->map }});
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
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
                "yaw": 180,
                // "hfov": 80,
                "previewTitle": "{{ $museum->scenes->sortBy('id')->first()->title }}",
                "showControls": true,
                "showZoomCtrl": false,
                "showFullscreenCtrl": false,
                "compass": false,
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
                                const mediaWindow = document.getElementById('panorama');
                                mediaWindow.insertAdjacentHTML('afterbegin', `{{ view('document', ['document' => $hotspot->document]) }}`);

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

        export let viewer = pannellum.viewer('panorama', obj);

        // Отслеживание смены сцены и смена радио
        viewer.on('scenechange', function(ev) {
            let hotSpot = document.getElementById(ev);
            hotSpot.firstElementChild.checked = true;
        });

        /**
         * Функция закрытия описания хотспота
         * @param { String } id Id раскрывающегося описания
         */

        function cross(id) {
            let media1 = document.getElementById(id);
            media1.remove();
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
        })
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/greghub/green-audio-player/dist/css/green-audio-player.min.css">
    <script src="https://cdn.jsdelivr.net/gh/greghub/green-audio-player/dist/js/green-audio-player.min.js"></script>
    <script>
        function cross(id) {
            let media1 = document.getElementById(id);
            media1.remove();
        }
    </script>
</head>

<body>

<div id="panorama">
    <div id="controls">
        <div class="ctrl toggle-bar" id="toggle-bar">&#9661;</div>
        <div class="visible ctrl-toggle-on">
            <div class="ctrl ctrl-nav" id="pan-up">&#8593;</div>
            <div class="ctrl ctrl-nav" id="pan-down">&#8595;</div>
            <div class="ctrl ctrl-nav" id="pan-left">&#8592;</div>
            <div class="ctrl ctrl-nav" id="pan-right">&#8594;</div>
            <div class="ctrl ctrl-nav" id="zoom-in">&plus;</div>
            <div class="ctrl ctrl-nav" id="zoom-out">&minus;</div>
            <div class="ctrl ctrl-nav" id="fullscreen">&#x2922;</div>
        </div>
    </div>
    <button class="map-toggle" onclick="toggleMap()">
        <img src="{{ Storage::url('assets/map.svg') }}" alt="map" height="15px">
    </button>
    <div class="map">
        @foreach($museum->scenes as $scene)
        <div class="point" id="scene-{{ $scene->getKey() }}" style="position: absolute; top: {{ $scene->map_y-6 }}%; left: {{ $scene->map_x-2.5 }}%">
            <input @if($scene->getKey() === $museum->scenes->first()->getKey()) checked @endif type="radio" name="radio-group" id="scene-{{ $scene->getKey() }}">
            <label for="scene-{{ $scene->getKey() }}"></label>
        </div>
        @endforeach
    </div>
</div>
<script>
    // if (/iPhone/ig.test(navigator.userAgent)) {
    //     document.getElementById("panorama").style.maxHeight = "86.6vh";
    // }
    const map = document.querySelector('.map');
    function toggleMap () {
        map.classList.toggle('map-toggle-on');
    }
    function toggleText(id) {
        const mediaText = document.getElementById(id);
        mediaText.classList.toggle('media-description-text-padding');
        const mediaToggler = document.getElementById('toggler-text');
        mediaToggler.classList.toggle('toggler-text-rotate');
    }
</script>
</body>

</html>
