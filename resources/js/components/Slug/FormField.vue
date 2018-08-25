<template>
    <default-field :field="field">
        <template slot="field">
            <input :id="field.name" type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
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
        Nova.$on('field-update-' + this.field.name, ({value}) => {
            this.value = slugify(value);
        })
    },

    methods: {
        
        /*
         * Generate the slug
         */
        generateSlug(value) {
            Nova.request().get('/nova-vendor/novaslugfield/slugify?str=' + encodeURI(value)).then(response => {
                this.value = response.data.slug;
            });
        },
        
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
