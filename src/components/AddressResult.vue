<template>
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg text-center">
    <h3 class="inline-flex items-center mb-4">
      <MapMarker class="w-8 h-8 inline-block"/>
      <span class="text-xl font-bold">Endereço</span>
    </h3>
    <p class="text-gray-600">
      {{ address.street }}, {{ address.neighborhood }}<br />
      {{ address.city }} - {{ address.state }}<br />
      CEP: {{ address.zip }}
    </p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import type { Address } from '@/types';
import MapMarker from 'vue-material-design-icons/MapMarker.vue';

export default defineComponent({
  name: 'AddressResult',
  components: {
    MapMarker,
  },
  props: {
    address: {
      type: Object as () => Address,
      required: true,
    },
  },
});
</script>
