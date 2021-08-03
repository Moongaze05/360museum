<div data-controller="imgmap"
     data-imgmap-measure="{{ $measureUnit }}"
     data-imgmap-x="{{ $targetX }}"
     data-imgmap-y="{{ $targetY }}"
     data-imgmap-action="{{ $action ?? '' }}"
     data-imgmap-modal="{{ $settingsModal }}"
>
    <div class="border-dashed text-end p-3 picture-actions">
        <div class="map" data-imgmap-target="map" style="position: relative">
            <img width="100%" id="map-image" src="{{ $image }}" alt="">
            @foreach($childs as $point)
            <div class="point"
                 id="mapper-map"
                 style="position: absolute; left: {{ $point['x'] }}%; top: {{ $point['y'] }}%;"
            >
                <input checked
                       class="mapper-map__point"
                       type="radio"
                       name="radio-group"
                       id="{{ $point['id'] }}"
                >
                <label for="mapper-map"></label>
            </div>
            @endforeach
        </div>
        <input data-imgmap-target="targetX" name="{{ $childKey }}[{{ $childKeyX }}]" hidden>
        <input data-imgmap-target="targetY" name="{{ $childKey }}[{{ $childKeyY }}]" hidden>
        <input data-imgmap-target="parent_id" name="parent_id" value="{{ $parent }}" hidden>
    </div>

</div>
