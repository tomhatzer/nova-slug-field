<template>
  <DefaultField
      :field="currentField"
      :errors="errors"
  >
    <template #field>
            <input
                class="w-full form-control form-input form-input-bordered"
                :id="currentField.uniqueKey"
                :dusk="currentField.attribute"
                v-model="value"
                @keyup="handleKeydown"
                v-bind="extraAttributes"
                :disabled="currentlyIsReadonly"
            />
        </template>
  </DefaultField>
</template>
<script>
    import { DependentFormField, FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [DependentFormField, HandlesValidationErrors, FormField],

        computed: {
            defaultAttributes() {
                return {
                    type: this.currentField.type || 'text',
                    min: this.currentField.min,
                    max: this.currentField.max,
                    step: this.currentField.step,
                    pattern: this.currentField.pattern,
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
            }
        },

        methods: {
            handleKeydown(event) {
                Nova.$emit('field-update-' + this.currentField.slug, {
                    value: event.target.value
                })
            },
        },
    }
</script>
