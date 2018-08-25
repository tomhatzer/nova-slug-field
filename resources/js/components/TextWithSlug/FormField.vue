<template>
    <default-field :field="field">
        <template slot="field">
            <input
                    :id="field.name"
                    :dusk="field.attribute"
                    type="text"
                    @keyup="handleKeydown"
                    v-model="value"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="field.name"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [HandlesValidationErrors, FormField],

        methods: {
            handleKeydown(event) {
                Nova.$emit('field-update-' + this.field.slug, {
                    value: event.target.value
                })
            },
        },
    }
</script>
