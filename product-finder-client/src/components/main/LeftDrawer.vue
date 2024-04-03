<template>
    <div class="relative flex flex-col justify-between bg-white shadow-lg inset-y-0 left-0 w-auto z-30 p-2">
      <div class="flex flex-col">
        <div class="flex flex-row items-center font-neering transition hover:bg-violet-50 rounded-md">
          <div>
            <img class="object-none object-center w-16 h-16" :src="isActive('/') ? homeIcon : homeIconGray">
          </div>
          <div class="text-sm w-full px-4">
            <RouterLink :class="{ 'font-semibold': $route.path === '/' }" to="/">Inicio</RouterLink>
          </div>
        </div>
        <div class="flex flex-row items-center font-neering transition hover:bg-violet-50 rounded-md">
          <div class="w-16 h-16">
            <img class="object-none object-center w-16 h-16" :src="isActive('/users') ? usersIcon : usersIconGray">
          </div>
          <div class="text-sm w-full px-4">
            <RouterLink :class="{ 'font-semibold': $route.path === '/users' }" to="/users">Listado de usuarios</RouterLink>
          </div>
        </div>
        <div class="flex flex-row items-center font-neering transition hover:bg-violet-50 rounded-md">
          <div class="w-16 h-16">
            <img class="object-none object-center w-16 h-16" :src="isActive('/products') ? productsIcon : productsIconGray">
          </div>
          <div class="text-sm w-full px-4">
            <RouterLink :class="{ 'font-semibold': $route.path === '/products' }" to="/products">Listado de Productos</RouterLink>
          </div>
        </div>
      </div>
      <div class="flex flex-row items-center">
        <div class="p-1">
          <img class="w-16" src="../../assets/logos/Grupo 36.svg">
        </div>
        <div class="min-w-36 text-xs">
          Diseñado por Neering SPA
        </div>
      </div>
    </div>
  </template>
  
<script setup>

import { RouterLink, useRouter } from 'vue-router';

import homeIcon from "../../assets/icons/Grupo 947.svg";
import productsIcon from "../../assets/icons/Grupo 945.svg";
import usersIcon from "../../assets/icons/Grupo 946.svg";

import homeIconGray from "../../assets/icons/Grupo 943.svg";
import productsIconGray from "../../assets/icons/Grupo 944.svg";
import usersIconGray from "../../assets/icons/Grupo 942.svg";


const router = useRouter();

const isActive = (route) => {
    return router.currentRoute.value.path === route;
}
</script>

  