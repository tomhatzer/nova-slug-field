<template>
  <div :class="`text-${field.textAlign}`">
    <template v-if="fieldValue">
      <CopyButton
          v-if="fieldValue && field.copyable && !shouldDisplayAsHtml"
          @click.prevent.stop="copy"
          v-tooltip="__('Copy to clipboard')"
      >
        <span ref="theFieldValue">
          {{ fieldValue }}
        </span>
      </CopyButton>

      <span
          v-else-if="fieldValue && !field.copyable && !shouldDisplayAsHtml"
          class="whitespace-nowrap"
      >
        {{ fieldValue }}
      </span>
      <div
          @click.stop
          v-else-if="fieldValue && !field.copyable && shouldDisplayAsHtml"
          v-html="fieldValue"
      />
      <p v-else>&mdash;</p>
    </template>
    <p v-else>&mdash;</p>
  </div>
</template>

<script>
import { CopiesToClipboard, FieldValue } from 'laravel-nova'

export default {
  mixins: [CopiesToClipboard, FieldValue],

  props: ['resourceName', 'field'],

  methods: {
    copy() {
      this.copyValueToClipboard(this.field.value)
    },
  },
}
</script>
