<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <input
                class="w-full form-control form-input form-input-bordered"
                :id="field.attribute"
                :dusk="field.attribute"
                v-model="value"
                v-bind="extraAttributes"
                :disabled="isReadonly"
            />
            <div v-if="field.showPreviewUrl !== null" class="mt-6">
                <a :href=previewUrl target="_blank">{{ previewUrl }}</a>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
const slugify = require('speakingurl');

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    /**
     * Mount the component.
     */
    mounted() {
        Nova.$on('field-update-' + this.field.attribute, ({value}) => {
            if (this.field.disableAutoUpdateWhenUpdating === true && this.$router.currentRoute.name !== 'create') {
                return;
            }
            this.value = slugify(value, this.field.slugifyOptions || {});
        })
    },

    computed: {
        defaultAttributes() {
            return {
                type: this.field.type || 'text',
                min: this.field.min,
                max: this.field.max,
                step: this.field.step,
                pattern: this.field.pattern,
                showPreviewUrl: this.field.showPreviewUrl,
                placeholder: this.field.placeholder || this.field.name,
                class: this.errorClasses,
            }
        },

        extraAttributes() {
            const attrs = this.field.extraAttributes

            return {
                // Leave the default attributes even though we can now specify
                // whatever attributes we like because the old number field still
                // uses the old field attributes
                ...this.defaultAttributes,
                ...attrs,
            }
        },

        previewUrl() {
            return this.field.showPreviewUrl + '/' + this.value;
        }
    },

    methods: {

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
          this.value = value
        }
    }
}
</script>
