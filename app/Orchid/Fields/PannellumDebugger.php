<?php

namespace App\Orchid\Fields;

use App\Models\Hotspot;
use Orchid\Screen\Field;

/**
 * @method self action(string $action)
 * @method self settingsModal(string $value)
 * @method self urlKey(string $value)
 * @method self hotspotsKey(string $value)
 * @method self newHotspotKey(string $value)
 */
class PannellumDebugger extends Field
{
    protected $view = 'dashboard.pannellum-debugger';

    protected $attributes = [
        'height' => '500px',
        'hotspotsKey' => 'hotspots',
        'newHotspotKey' => 'hotspot',
    ];

    protected $inlineAttributes = [
        'name',
        'panorama',
        'settingsModal',
        'action',
    ];

    public function hotspotsSerializeToFront(): static
    {
        $scene = $this->attributes['value'];
        $hotspots = $scene->{$this->attributes['hotspotsKey']}->map(function (Hotspot $hotspot) {
            return [
                'id' => $hotspot->getKey(),
                'pitch' => $hotspot->pitch,
                'yaw' => $hotspot->yaw,
                'type' => $hotspot->type,
                'text' => $hotspot->title,
                'route' => $hotspot->type === 'scene'?
                    route('museums.scenes.edit', $hotspot->target):
                    route('museums.documents.edit', $hotspot->document)
            ];
        });
        $this->attributes['hotspots'] = $hotspots;
        return $this;
    }

    public function render()
    {
        $this->hotspotsSerializeToFront();
        $key = $this->attributes['urlKey'];
        $this->attributes['scene'] = $this->attributes['value']['id'];

        $this->attributes['panorama'] = $this->attributes['value']->$key;
        return parent::render();
    }
}
