<?php
declare(strict_types=1);

namespace Benjaminhirsch\NovaSlugField;

use Laravel\Nova\Fields\Field;

class Slug extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-slug-field';
}
