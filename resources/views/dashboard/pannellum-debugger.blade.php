<div data-controller="pnldbg"
     data-pnldbg-panorama="{{ $panorama }}"
     data-pnldbg-name="{{ $name }}"
     data-pnldbg-action="{{ $action ?? '' }}"
     data-pnldbg-modal="{{ $settingsModal }}"
     data-pnldbg-hotspots="{{ $hotspots }}"
>
    <div id="{{ $name }}" class="border w-100 mb-2" style="height: {{ $height }};"></div>

    <input id="pitch" class="pnldbg-target-input" name="{{ $newHotspotKey }}[pitch]" hidden data-pnldbg-target="pitch">
    <input id="yaw" class="pnldbg-target-input" name="{{ $newHotspotKey }}[yaw]" hidden data-pnldbg-target="yaw">
    <input id="scene" class="pnldbg-target-input" name="{{ $newHotspotKey }}[scene]" value="{{ $scene }}" hidden data-pnldbg-target="scene">
</div>
