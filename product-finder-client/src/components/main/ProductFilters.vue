<template>
    <div class="flex flex-row justify-between items-center w-full">
      <div class="flex flex-row w-full items-center rounded-sm bg-white p-2">
        <div class="flex flex-row items-center rounded-sm bg-white p-2">
          <div class="flex flex-row items-center">
            <input
              class="bg-slate-200 rounded-sm font-neering text-xs p-1.5 md:w-80"
              placeholder="Buscar..."
            />
          </div>
          <div class="px-4">
            <select
              v-model="selectedFilter"
              class="sm:w-40 font-neering text-xs p-1 rounded-sm bg-slate-200"
              type="text"
              id="filterby"
              name="filterby"
              @change="handleChange"
            >
              <option disabled value="">Filtrar</option>
              <option value="nofilter">Sin filtro</option>
              <option value="available">Disponibles</option>
              <option value="unavailable">No Disponibles</option>
            </select>
          </div>
        </div>
        <div class="flex flex-row items-center rounded-sm bg-white">
          <div class="flex flex-row items-center">
            <div>
              <button
                @click="handleSearch"
                class="bg-purple-600 text-xs font-neering font-semibold transition-colors hover:bg-purple-800 text-white font-display py-2 px-8 rounded"
              >
                Buscar
              </button>
            </div>
            <div>
              <div v-if="isAddModalOpen">
                <AddProductModal @close="isAddModalOpen = false" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  
  const selectedFilter = ref("nofilter");
  const isAddModalOpen = ref(false);
  
  function handleSearch() {
    // Implement search functionality
  }
  
  function handleChange() {
    // Handle filter change
  }
  
  </script>