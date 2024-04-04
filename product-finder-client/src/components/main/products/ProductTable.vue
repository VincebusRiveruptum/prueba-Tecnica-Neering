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
          <th class="text-xs font-neering">Stock</th>
          <th class="text-xs font-neering">Precio</th>
          <th class="text-xs font-neering">Opciones</th>
        </tr>
      </thead>
      <tbody class="text-xs">
        <tr class="border-b-2" v-for="product in props.products">
          <td class="p-2 font-neering font-bold">
            <div class="flex flex-row justify-center items-center">
              <div>
                <img class="px-2" src="../../../assets/icons/Elipse%2016.png" />
              </div>
            </div>
          </td>
          <td class="p-1 font-neering font-bold">
            <div class="flex flex-row items-center">
              <div>
                {{ product.name }}
              </div>
            </div>
          </td>
          <td class="p-2 font-neering text-center items-center">
            <Badge :yesno="product.available" yestext="Disponible" notext="No disponible"/>
          </td>
          <td class="p-2 font-neering text-center items-center font-bold">
            ${{ product.price }}
          </td>
          <td>
            <div class="flex flex-row items-center justify-center">
                <img
                  @click="handleProductDetails(product.id)"
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
import { RouterView, useRouter } from 'vue-router';
import Badge from "../Badge.vue";

const selectedProductId = ref(null);
const router = useRouter();

const props = defineProps({
  products:{
    type:Object,
    required:true,
  },
});

function handleDelete(id){
  selectedProductId.value = id;
}

function handleProductDetails(id){
  router.push('/products/' + id )
  .catch(failure => console.log(failure))
}
</script>
