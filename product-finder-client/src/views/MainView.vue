
<template>
  <TopNavBar/>
  <div class="sm:flex sm:flex-row sm:h-screen ">
    <LeftDrawer class="invisible w-0 h-0 sm:visible sm:w-auto sm:h-auto"/>
    <div class="bg-slate-100 -translate-y-10 p-4 w-full sm:translate-y-0">
      <RouterView/>
    </div>  
  </div>
</template>

<script setup>
import { RouterView } from "vue-router";
import TopNavBar from '../components/main/TopNavBar.vue';
import LeftDrawer from '../components/main/LeftDrawer.vue';


// invisible w-0 h-0 sm:visible sm:w-auto sm:h-auto

</script>
