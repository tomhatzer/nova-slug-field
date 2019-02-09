<?php
declare(strict_types=1);

namespace Benjaminhirsch\NovaSlugField;

use Laravel\Nova\Element;
use Laravel\Nova\Fields\Field;

class Slug extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-slug-field';

    /**
     * Specify options to pass to speakingurl.
     *
     * @param array $options
     *
     * @return $this
     */
    public function slugifyOptions(array $options): Element
    {
        return $this->withMeta(['slugifyOptions' => $options]);
    }
}
