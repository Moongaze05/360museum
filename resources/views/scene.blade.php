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
                "firstScene": "{{ $museum->scenes()->first()->getKey() }}",
                "sceneFadeDuration": 2000,
                "autoLoad": true,
                "autoRotate": 0,
                "autoRotateInactivityDelay": 5000,
                "yaw": 180,
                // "hfov": 80,
                "previewTitle": "{{ $museum->scenes()->first()->title }}",
                "showControls": true,
                "showZoomCtrl": false,
                "showFullscreenCtrl": false,
                "compass": false,
            },

            "scenes": {
                @foreach($museum->scenes()->get() as $scene)
                "{{ $scene->getKey() }}": {
                    "title": "{{ $scene->title }}",
                    "sceneId": "{{ $scene->getKey() }}",
                    "type": "equirectangular",
                    "panorama": "{{ $scene->panorama }}",
                    // "hotSpotDebug": "true",
                    "hotSpots": [
                        @foreach($scene->hotspots() as $hotspot)
                        {
                            "pitch": {{ $hotspot->pitch }},
                            "yaw": {{ $hotspot->yaw }},
                            "type": "{{ $hotspot->type }}",
                            "text": `"aboba" <br/> govno sjelo zhopu`,
                            "clickHandlerFunc": function() {
                                let mediaWindow = document.getElementById('panorama');
                                mediaWindow.insertAdjacentHTML('afterbegin', description);

                                function audioPlay() {
                                    new GreenAudioPlayer('.media-description-custom-audio');
                                }
                                audioPlay();
                                },
                        },
                        @endforeach
                        {
                            "pitch": -10,
                            "yaw": -50,
                            "type": "info",
                            "text": "This is a link.",
                            "URL": "https://github.com/mpetroff/pannellum"
                        },
                        {
                            "pitch": -35,
                            "yaw": 277,
                            "type": "scene",
                            "text": "Второй зал",
                            "sceneId": "b-scene"
                        }
                    ]
                },
                @endforeach
            }
        }

        export let viewer = pannellum.viewer('panorama', obj);

        viewer.startOrientation()
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

        let svgData = `<svg class="svg-sector" id="sector">
<path fill="rgb(255,255,255)" fill-opacity="0.7" d="M 65.5,65.5 L 23.34187850181081,17.347193313951905 A 64,64 0 0 1 107.65812149818916,17.347193313951877 Z"></path>
</svg>`;

        viewer.on('scenechange', function(ev) {
            let prePoint = document.getElementById('sector');
            prePoint.remove();
            let point = document.getElementById(ev);
            point.insertAdjacentHTML("beforeend", svgData);
        });


        // Вращение сектора обзора

        viewer.on('zoomchange', function() {
            // console.log(viewer.getYaw())
            let prPoint = document.getElementById('sector');
            prPoint.style.transform = `rotate(${viewer.getYaw()+180}deg)`;
        })
        document.getElementsByClassName('pnlm-dragfix')[0].addEventListener('mousemove', function() {
            let prPoint = document.getElementById('sector');
            prPoint.style.transform = `rotate(${viewer.getYaw()+180}deg)`;
        })
        document.getElementsByClassName('pnlm-dragfix')[0].addEventListener('touchmove', function() {
            let prPoint = document.getElementById('sector');
            prPoint.style.transform = `rotate(${viewer.getYaw()+180}deg)`;
        })

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

    <div class="map">
        <div class="point" id="a-scene">
            <input type="radio" name="radio-group" id="a-radio" checked>
            <label for="1-radio">1</label>
            <svg class="svg-sector" id="sector">
                <path fill="rgb(255,255,255)" fill-opacity="0.7" d="M 65.5,65.5 L 23.34187850181081,17.347193313951905 A 64,64 0 0 1 107.65812149818916,17.347193313951877 Z"></path>
            </svg>
        </div>
        <div class="point" id="b-scene">
            <input type="radio" name="radio-group" id="b-radio">
            <label for="b-radio">2</label>
        </div>
    </div>
</div>
</body>

</html>
