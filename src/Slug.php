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
     * Optionally show a full url
     * @var null|string
     */
    private $showUrlPreview;

    /**
     * Passing options to the js library used for the slug generation
     * https://www.npmjs.com/package/speakingurl
     *
     * @var array
     */
    private $slugifyOptions = [];

    /**
     * Specify options to pass to speakingurl.
     *
     * @param array $options
     *
     * @return $this
     */
    public function slugifyOptions(array $options): Element
    {
        $this->slugifyOptions = $options;
        return $this;
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

    /**
     * Specify that the element should not be automatically updated when
     * updating the parent field
     *
     * @return $this
     */
    public function showUrlPreview(string $url): Element
    {
        $this->showUrlPreview = $url;
        return $this;
    }

    /**
     * Display the field as raw HTML using Vue.
     *
     * @return $this
     */
    public function asHtml()
    {
        return $this->withMeta(['asHtml' => true]);
    }

    public function jsonSerialize()
    {
        return array_merge([
            'disableAutoUpdateWhenUpdating' => $this->disableAutoUpdateWhenUpdating,
            'slugifyOptions' => $this->slugifyOptions,
            'showPreviewUrl' => $this->showUrlPreview,
        ], parent::jsonSerialize());
    }
}
