<template>
  <div class="px-4">
    <select v-model="selectedValue" class="sm:w-40 font-neering text-xs p-1 rounded-sm" type="text" id="filterby" name="filterby">
      <option disabled value="">Filtar</option>
      <option value="nofilter">Sin filtro</option>
      <option value="active">Activos</option>
      <option value="inactive">Inactivos</option>
    </select>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const selectedValue = ref('nofilter');
</script>