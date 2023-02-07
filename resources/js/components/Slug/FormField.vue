<template>
  <DefaultField :field="currentField" :errors="errors">
    <template #field>
      <div class="space-y-1">
        <input
            v-bind="extraAttributes"
            class="w-full form-control form-input form-input-bordered"
            v-model="value"
            :id="currentField.uniqueKey"
            :dusk="field.attribute"
            :disabled="currentlyIsReadonly"
        />
        <div v-if="currentField.showPreviewUrl !== null" class="mt-6">
            <a :href=previewUrl target="_blank">{{ previewUrl }}</a>
        </div>
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, FormField, HandlesValidationErrors } from 'laravel-nova'
const slugify = require('speakingurl');

export default {
    mixins: [DependentFormField, FormField, HandlesValidationErrors],
    /**
     * Mount the component.
     */
    mounted() {
        Nova.$on('field-update-' + this.currentField.attribute, ({value}) => {
            if (this.currentField.disableAutoUpdateWhenUpdating === true && this.editMode !== 'create') {
                return;
            }
            this.value = slugify(value, this.currentField.slugifyOptions || {});
            this.appendSlugPrefix(this.value);
        })
    },

    computed: {
        defaultAttributes() {
            return {
                type: this.currentField.type || 'text',
                min: this.currentField.min,
                max: this.currentField.max,
                step: this.currentField.step,
                pattern: this.currentField.pattern,
                showPreviewUrl: this.currentField.showPreviewUrl,
                placeholder: this.currentField.placeholder || this.currentField.name,
                class: this.errorClasses,
            }
        },

        extraAttributes() {
            const attrs = this.currentField.extraAttributes

            return {
                // Leave the default attributes even though we can now specify
                // whatever attributes we like because the old number field still
                // uses the old field attributes
                ...this.defaultAttributes,
                ...attrs,
            }
        },

        previewUrl() {
            return this.currentField.showPreviewUrl + '/' + this.value;
        }
    },

    methods: {

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.currentField.value || ''
          if(this.editMode === 'create') {
            this.appendSlugPrefix() 
          }
        },

        /*
         * Add slug prefix to slug if it is set
         */
        appendSlugPrefix() {
          if(this.currentField.slugPrefix) {
            this.value = this.currentField.slugPrefix + '/' + this.value
          }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.currentField.attribute, this.value || '')
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
