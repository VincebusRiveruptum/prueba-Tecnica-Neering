<script setup>
import { RouterLink, RouterView } from "vue-router";
import TopNavBar from '../components/main/TopNavBar.vue';
import LeftDrawer from '../components/main/LeftDrawer.vue';

</script>

<template>
  <TopNavBar/>
  <div class="flex flex-row h-screen">
    <LeftDrawer/>
    <div class="bg-slate-100 p-4 w-full">
      <RouterView/>
    </div>  
  </div>
</template>