<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

/**
 * @method self measureUnit(string $value)
 * @method self imageKey(string $value)
 * @method self targetX(string $value)
 * @method self targetY(string $value)
 * @method self settingsModal(string $value)
 * @method self action(string $value)
 * @method self childKey(string $value)
 * @method self pointsKey(string $value)
 * @method self pointsXKey(string $value)
 * @method self pointsYKey(string $value)
 */
class ImgMap extends Field
{
    protected $view = 'dashboard.imgmapper';

    protected $attributes = [
        'measureUnit' => 'px',
        'targetX' => 'x',
        'targetY' => 'y',
        'childKey' => 'additional',
        'childKeyX' => 'parent_x',
        'childKeyY' => 'parent_y',
        'pointsKey' => 'additional',
        'pointsXKey' => 'parent_x',
        'pointsYKey' => 'parent_y',
        'imageKey' => 'image'
    ];

    protected $inlineAttributes = [
        'settingsModal',
        'action',

    ];

    public function render()
    {
        $this->attributes['image'] = $this->attributes['value']->{$this->attributes['imageKey']};
        $this->attributes['parent'] = $this->attributes['value']->getKey();

        $this->attributes['childs'] = collect($this->attributes['value']->{$this->attributes['childKey']})
            ->map(fn ($val) => [
                'id' => $val->getKey(),
                'x' => $val->{$this->attributes['pointsXKey']},
                'y' => $val->{$this->attributes['pointsYKey']},
            ]);



        return parent::render();
    }

}
