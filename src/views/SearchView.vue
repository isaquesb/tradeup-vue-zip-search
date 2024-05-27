<template>
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg text-center mb-10">
    <div class="flex items center gap-5">
      <router-link to="/" class="text-blue-500 hover:text-blue-700">
        <ArrowLeftIcon class="w-8 h-10 inline-block"/>
      </router-link>
      <h2 class="flex items-center justify-center gap-3 mb-4">
        <span class="text-2xl font-bold">Buscar CEP</span>
        <SearchIcon class="w-8 h-8 inline-block"/>
      </h2>
    </div>
    <form class="flex flex-col space-y-4" @submit.prevent="zipSearch">
      <input
          v-model="zip"
          @input="validateZip"
          max="8"
          type="text"
          class="border border-gray-300 rounded p-2 w-full"
          placeholder="Digite o ZIP"
          autofocus
          required
      />
      <span v-if="zipError" class="text-red-500">{{ zipError }}</span>
      <button
          type="submit"
          :disabled="zipError || loading"
          class="inline-flex justify-center items-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700"
          :class="{ 'cursor-not-allowed': zipError || loading, 'bg-gray-300 hover:bg-gray-300': zipError || loading}"
      >
        <span>Buscar</span>
        <SearchButtonIcon class="w-6 h-6 inline-block ml-2"/>
      </button>
    </form>
  </div>

  <div v-if="loading" class="text-gray-600">Carregando...</div>
  <div v-if="error" class="text-red-500">{{ error }}</div>
  <AddressResult :address="address" v-if="address" />
</template>

<script lang="ts">
import { defineComponent, computed, ref } from 'vue';
import { useStore } from 'vuex';
import AddressResult from '@/components/AddressResult.vue';
import SearchIcon from 'vue-material-design-icons/MapSearch.vue';
import SearchButtonIcon from 'vue-material-design-icons/Magnify.vue';
import ArrowLeftIcon from 'vue-material-design-icons/ChevronLeft.vue';

export default defineComponent({
  name: 'SearchView',
  components: {
    SearchIcon,
    SearchButtonIcon,
    ArrowLeftIcon,
    AddressResult,
  },
  setup() {
    const store = useStore();
    const zip = ref('');
    const zipError = ref('');

    const validateZip = () => {
      const zipPattern = /^[0-9]{8}$/;
      if (!zipPattern.test(zip.value)) {
        zipError.value = 'CEP deve ter 8 dígitos e conter apenas números. Ex: 06145000';
      } else {
        zipError.value = '';
      }
    };

    const zipSearch = () => {
      store.dispatch('zipSearch', zip.value);
    };

    const address = computed(() => store.getters.address);
    const loading = computed(() => store.getters.loading);
    const error = computed(() => store.getters.error);

    return {
      zip,
      zipSearch,
      validateZip,
      address,
      loading,
      error,
      zipError,
    };
  },
});
</script>
