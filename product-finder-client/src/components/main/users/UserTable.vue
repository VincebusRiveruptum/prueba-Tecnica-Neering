<template>
  <div v-if="props.users && props.users.length > 0" class="w-full p-2 pb-12">
    <table class="md:table-fixed w-full">
      <thead class="border-b-2">
        <tr>
          <th class="text-xs font-neering">Nombre</th>
          <th class="text-xs font-neering">Fecha de Creación</th>
          <th class="text-xs font-neering">Estado</th>
          <th class="text-xs font-neering">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b-2" v-for="user in props.users">
          <td class="text-sm p-2 font-neering font-bold">
            <div class="flex flex-row items-center">
                <div>
                    <img
                    class="px-2"
                    src="../../../assets/icons/Elipse%2016.png"
                  />
                </div>
                <div>
                    {{ user.name }}
                </div>

            </div>
          </td>
          <td class="text-sm p-2 font-neering text-center items-center">
            {{ (new Date(user.created_at)).toLocaleDateString() }}
          </td>
          <td
            class="text-sm p-2 font-neering text-center items-center font-bold"
          >
            <div v-if="user.active">
              <span class="inline-flex items-center rounded-md bg-sky-400 px-6 py-1 text-sm font-light text-white font-medium">Activo</span>
            </div>
            <div v-else>
              <span class="inline-flex items-center rounded-md bg-slate-200 px-6 py-1 text-sm font-light text-white font-medium">Inactivo</span>  
              
            </div>
          </td>
          <td>
            <div class="flex flex-row items-center justify-center">
              <img
                 class="px-2 hover:scale-125 filter brightness-100 hover:brightness-200 transition-all"
                src="../../../assets/icons/Componente%2020%20–%2025.svg"
              />
              <img
                @click="handleDelete(user.id)"class="px-2 hover:scale-125 filter brightness-100 hover:brightness-150 transition-all"
                src="../../../assets/icons/Componente%2021%20–%207.svg"
              />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    
  </div>
  <div v-else class="font-neering p-4">No hay usuarios para listar</div>
  <DeleteUserModal v-if="userToDeleteId !== null" :userId="userToDeleteId" @close="userToDeleteId = null" />
</template>

<script setup>

import { indexUsersRanged } from "../../../api/api";
import { computed, watch, ref, defineProps} from 'vue';
import DeleteUserModal from './DeleteUserModal.vue';

const props = defineProps({
  users:{
    type:Object,
    required:true,
  }
});

const userToDeleteId =  ref(null);

function handleDelete(userId){
    userToDeleteId.value = userId;
}


</script>
