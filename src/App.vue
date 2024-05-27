<template>
  <header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-5">
      <div class="text-2xl font-bold">
        <router-link to="/">
          <img src="./assets/logo.png" alt="TradeUp Group" class="h-10 inline-block mr-2"/>
        </router-link>
      </div>
      <nav>
        <ul class="flex space-x-4">
          <li><router-link to="/" class="text-gray-600 hover:text-gray-800">Home</router-link></li>
          <li><router-link to="/buscar-cep" class="text-gray-600 hover:text-gray-800">Busca de Cep</router-link></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="flex flex-col items-center justify-center p-5">
    <router-view/>
  </main>
</template>
<script setup lang="ts">
</script>
