<template>
  <div
    v-if="props.products != null && props.products.length > 0"
    class="w-full p-2 pb-12"
  >
    <table class="md:table-fixed w-full">
      <thead class="border-b-2">
        <tr>
          <th class="text-xs font-neering">Foto</th>
          <th class="text-xs font-neering">Nombre</th>
          <th class="text-xs font-neering">SKU</th>
          <th class="text-xs font-neering">Precio</th>
          <th class="text-xs font-neering">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b-2" v-for="product in props.products">
          <td class="text-sm p-2 font-neering font-bold">
            <div class="flex flex-row items-center">
              <div>
                <img class="px-2" src="../../../assets/icons/Elipse%2016.png" />
              </div>
            </div>
          </td>
          <td class="text-sm p-5 font-neering font-bold">
            <div class="flex flex-row items-center">
              <div>
                {{ product.name }}
              </div>
            </div>
          </td>
          <td class="text-sm p-2 font-neering text-center items-center">
            {{ product.sku }}
          </td>
          <td class="text-sm p-2 font-neering text-center items-center font-bold">
            {{ product.price }}
          </td>
          <td>
            <div class="flex flex-row items-center justify-center">
              <img
                 class="px-2 hover:scale-125 filter brightness-100 hover:brightness-200 transition-all"
                  src="../../../assets/icons/Componente%2020%20–%2025.svg"
              />
              <img
                @click="handleDelete(product.id)"class="px-2 hover:scale-125 filter brightness-100 hover:brightness-150 transition-all"
                src="../../../assets/icons/Componente%2021%20–%207.svg"
              />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-else class="font-neering p-4">No hay productos a listar</div>
    <DeleteProductModal v-if="selectedProductId !== null" :productId="selectedProductId" @close="selectedProductId = null" />
</template>

<script setup>

import { ref, defineProps, watch,computed } from 'vue';
import { productIndexRanged } from "../../../api/api";
import DeleteProductModal from './DeleteProductModal.vue';

const selectedProductId = ref(null);

const props = defineProps({
  products:{
    type:Object,
    required:true,
  },
});

function handleDelete(id){
  selectedProductId.value = id;
}

</script>
