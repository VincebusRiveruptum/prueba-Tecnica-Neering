<template>
  <div class="flex flex-row justify-between items-center w-full p-2">
    <div class="flex flex-row items-center">
      <h1 class="font-neering font-semibold text-md">Listado de Productos</h1>
    </div>
    <div>
      <button
        @click="handleModalOpen"
        class="bg-purple-600 text-xs font-neering font-semibold transition-colors hover:bg-purple-800 text-white font-display py-2 px-8 rounded"
      >
        Agregar
      </button>
    </div>
  </div>

  <div class="flex flex-row justify-between items-center w-full">
    <div class="flex flex-row w-full items-center rounded-sm bg-white p-2">
      <div class="flex flex-row items-center rounded-sm bg-white p-2">
        <div class="flex flex-row items-center">
          <input
            v-model="searchValue" class="bg-slate-200 rounded-sm font-neering text-xs p-1.5 md:w-80"
            placeholder="Buscar..."
          />
        </div>
        <div class="px-4">
          <select
            v-model="filterValue"
            class="sm:w-40 font-neering text-xs p-1 rounded-sm bg-slate-200"        
            id="filterby"
            name="filterby"
          >
            <option disabled value="">Filtar</option>
            <option value="nofilter">Sin filtro</option>
            <option value="avalailable">Disponibles</option>
            <option value="unavailable">No Disponibles</option>
          </select>
        </div>
      </div>
      <div class="flex flex-row items-center rounded-sm bg-white">
        <div class="flex flex-row items-center">
          <div>
            <button
            @click="handleSearch"
            :disabled="isSubmitting" class="bg-purple-600 text-xs font-neering font-semibold transition-colors hover:bg-purple-800 disabled:bg-slate-500 text-white font-display py-2 px-8 rounded"
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
    <div v-if="searchMessage" class="px-4 items-center font-neering text-sm font-semibold w-full">
        <NotificationBar :message="searchMessage" :success="false"/>
    </div>
  </div>
</div>
  <hr />
  <div class="flex flex-col w-full shadow-lg rounded-sm bg-white p-6">
    <ProductTable :products="products" />
    <PaginationControls :page="page" :disabled="isSubmitting" :totalPages="totalPages" @prev="prevPage" @next="nextPage" />
  </div>



  <div>
    <RouterView></RouterView>
  </div>



</template>

<script setup>

import { RouterView } from "vue-router";

import { ref, defineProps, computed } from "vue";
import { productIndexRanged, productIndexFiltered } from "../../api/api";
import ProductTable from "./products/ProductTable.vue";
import AddProductModal from "./products/AddProductModal.vue";
import DeleteProductModal from "./products/DeleteProductModal.vue";
import PaginationControls from './PaginationControls.vue';
import NotificationBar from './NotificationBar.vue';

const filterValue = ref("nofilter");
const searchValue = ref("");
const isAddModalOpen = ref(false);
const page = ref(1);
const perPage = ref(5);
const products = ref([]);
const totalProducts = ref(0);
const selectedProductId = ref(null);
const isSubmitting = ref(false);
const searchMessage = ref(null);

const totalPages = computed(() =>
  Math.ceil(totalProducts.value / perPage.value)
);

function handleModalOpen() {
  isAddModalOpen.value = true;
}

async function handleSearch(){
    isSubmitting.value = true;
    page.value=1;
    await fetchFilteredProducts();
    isSubmitting.value = false;

}

async function fetchProducts() {
  const response = await productIndexRanged(
    page.value,
    perPage.value,
  );
  const content = response.data["content"];
  //console.log(content);
  if (content !== null) {
    products.value = content["data"];
    totalProducts.value = content["total"];
  } else {
    console.log("Could not fetch products");
  }
}

async function fetchFilteredProducts() {
  try{
    const response = await productIndexFiltered(
      page.value,
      perPage.value,
      filterValue.value,
      searchValue.value,
    );
    
    const content = response.data["content"];

    if (content !== null) {
      products.value = content["data"];
      totalProducts.value = content["total"];
    } else {
      console.log("Could not fetch products");
    }
  }catch(error) {
    if (error.response && error.response.status === 403) {
      searchMessage.value = "Ya intentaste mas de cinco veces.";
    }
  }
}
async function nextPage() {
  if (page.value < totalPages.value) {
    page.value++;
    isSubmitting.value = true;
    await fetchProducts();
    isSubmitting.value = false;
  }
}

async function prevPage() {
  if (page.value > 1) {
    page.value--;
    isSubmitting.value = true;
    await fetchProducts();
    isSubmitting.value = false;
  }
}

function handleDelete(id) {
  selectedProductId.value = id;
}

fetchProducts();

</script>
