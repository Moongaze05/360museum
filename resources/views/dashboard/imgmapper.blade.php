<div data-controller="imgmap"
     data-imgmap-measure="{{ $measureUnit }}"
     data-imgmap-x="{{ $targetX }}"
     data-imgmap-y="{{ $targetY }}"
>
    <style>
        .map {
            background-image: url("{{ $value }}");
        }
    </style>
    <div class="border-dashed text-end p-3 picture-actions">
        <div class="map">
            <div class="point"
                 id="mapper-map"
                 style="position: absolute;"
            >
                <input checked
                       type="radio"
                       name="radio-group"
                       id="mapper-map"
                >
                <label for="mapper-map"></label>
            </div>
        </div>
    </div>

</div>
