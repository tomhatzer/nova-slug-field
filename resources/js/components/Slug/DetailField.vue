<template>
  <PanelItem :index="index" :field="field" />
</template>

<script>
export default {
    props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
