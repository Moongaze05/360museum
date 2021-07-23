<?php

namespace App\Orchid\Fields;

use Orchid\Screen\Field;

/**
 * @method self measureUnit(string $value)
 * @method self targetX(string $value)
 * @method self targetY(string $value)
 */
class ImgMap extends Field
{
    protected $view = 'dashboard.imgmapper';

    protected $attributes = [
        'measureUnit' => 'px',
        'targetX' => 'x',
        'targetY' => 'y'
    ];

    protected $inlineAttributes = [];

}
