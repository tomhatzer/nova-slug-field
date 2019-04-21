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
     * Disable auto update behavior
     *
     * @var bool
     */
    private $disableAutoUpdateWhenUpdating = false;

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

    /**
     * Specify that the element should not be automatically updated when
     * updating the parent field
     *
     * @return $this
     */
    public function disableAutoUpdateWhenUpdating(): Element
    {
        $this->disableAutoUpdateWhenUpdating = true;
        return $this;
    }

    public function jsonSerialize()
    {
        return array_merge([
            'disableAutoUpdateWhenUpdating' => $this->disableAutoUpdateWhenUpdating
        ], parent::jsonSerialize());
    }
}
