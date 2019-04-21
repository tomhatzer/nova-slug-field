<?php
declare(strict_types=1);

namespace Benjaminhirsch\NovaSlugField;

use Laravel\Nova\Element;
use Laravel\Nova\Fields\Text;

class TextWithSlug extends Text
{
    public $component = 'nova-textwithslug-field';

    /**
     * Specify the field that contains the actual slug.
     *
     * @param string $slugField
     *
     * @return $this
     */
    public function slug($slugField = 'slug'): Element
    {
        return $this->withMeta([__FUNCTION__ => $slugField]);
    }
}
