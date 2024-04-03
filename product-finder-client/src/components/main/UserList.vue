<template>
  <div class="flex flex-row justify-between items-center w-full p-2">
    <div class="flex flex-row items-center">
      <h1 class="font-neering font-semibold text-md">Listado de Usuarios</h1>
    </div>
    <div class="flex flex-row items-center">
      <div class="px-4">
        <select v-model="filterValue" @change="handleFilterChange" class="sm:w-40 font-neering text-xs p-1 rounded-sm" type="text" id="filterby" name="filterby">
          <option disabled value="">Filtar</option>
          <option value="nofilter">Sin filtro</option>
          <option value="active">Activos</option>
          <option value="inactive">Inactivos</option>
        </select>
      </div>
      <div>
        <button @click="handleModalOpen" class="bg-purple-600 text-xs font-neering font-semibold transition-colors hover:bg-purple-800 text-white font-display py-2 px-8 rounded">Agregar</button>
      </div>
      <div>
        <AddUserModal v-if="isAddModalOpen" @close="isAddModalOpen = false" />
      </div>
    </div>
  </div>
  <div class="flex flex-col w-full shadow-lg rounded-sm bg-white p-4">
    <UserTable :users="users" />
    <PaginationControls :page="page" :disabled="isSubmitting" :totalPages="totalPages" @prev="prevPage" @next="nextPage" />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { indexUsersRanged } from '../../api/api';
import UserTable from './users/UserTable.vue';
import AddUserModal from './users/AddUserModal.vue';
import PaginationControls from './PaginationControls.vue';

const filterValue = ref('nofilter');
const isAddModalOpen = ref(false);
const page = ref(1);
const perPage = ref(5);
const users = ref([]);
const totalUsers = ref(0);
const isSubmitting = ref(false);

async function fetchUsers() {
  const response = await indexUsersRanged(page.value, perPage.value, filterValue.value);
  const content = response.data['content'];
  if (content !== null) {
    users.value = content['data'];
    totalUsers.value = content['total'];
  } else {
    console.log("Could not fetch users");
  }
}

const totalPages = computed(() => Math.ceil(totalUsers.value / perPage.value));

async function nextPage() {
  if (page.value < totalPages.value) {
    page.value++;
    isSubmitting.value = true;
    await fetchUsers();
    isSubmitting.value = false;
  }
}

async function prevPage() {
  if (page.value > 1) {
    page.value--;
    isSubmitting.value = true;
    await fetchUsers();
    isSubmitting.value = false;
  }
}

function handleModalOpen() {
  isAddModalOpen.value = true;
}

async function handleFilterChange() {
  page.value = 1;
  await fetchUsers();
}

fetchUsers();
</script>