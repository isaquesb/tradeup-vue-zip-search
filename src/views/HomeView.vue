<template>
  <div class="bg-white p-10 rounded-lg shadow-md max-w-xl text-center">
    <HelloTitle msg="Bem-vindo à nossa Busca de Cep"/>
    <p class="text-gray-600 mb-6">Utilize nossa ferramenta para encontrar informações detalhadas sobre qualquer CEP no Brasil. Basta clicar no botão abaixo e iniciar sua busca!</p>
    <router-link to="/buscar-cep" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
      <span>Buscar um Cep Agora</span>
      <ChevronIcon :size="36" class="w-6 h-6 inline-block mr-2"/>
    </router-link>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import HelloTitle from '@/components/HelloTitle.vue';
import ChevronIcon from 'vue-material-design-icons/ChevronRight.vue';

export default defineComponent({
  name: 'HomeView',
  components: {
    HelloTitle,
    ChevronIcon,
  },
});
</script>
