<template>
  <h1 class="text-3xl font-bold mb-4">{{ msg }}</h1>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'HelloTitle',
  props: {
    msg: String,
  },
});
</script>
