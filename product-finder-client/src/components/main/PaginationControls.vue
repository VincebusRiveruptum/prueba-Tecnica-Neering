<template>
    <div class="flex font-neering justify-center items-center p-4">
      <button @click="$emit('prev')" :disabled=" disabled || page === 1" class="mx-2 px-2 y-1 bg-gray-200 text-white disabled:bg-white hover:bg-purple-500 transition rounded-full">
        <
      </button>
      <div class="flex">
        <span v-for="pageNumber in totalPages" :key="pageNumber" :class="{'bg-purple-600 text-neutral-100 ': page === pageNumber, 'bg-gray-200': page !== pageNumber}" class="text-xs text-neutral-400 font-bold px-2 py-1">{{ pageNumber }}</span>
      </div>
      <button @click="$emit('next')" :disabled="disabled || page >= totalPages" class="mx-2 px-2 y-1 bg-gray-200 text-white disabled:bg-white hover:bg-purple-500 transition rounded-full">
        >
      </button>
    </div>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const props = defineProps({
    page: Number,
    totalPages: Number,
    disabled:Boolean,
  });
  </script>