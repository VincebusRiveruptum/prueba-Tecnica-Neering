<template>
    <div class="relative z-40" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
      <div class="fixed inset-0 z-50 w-screen overflow-y-auto font-neering">
        <div class="flex min-h-full items-end justify-center text-center items-center">
          <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-32 sm:w-full sm:max-w-xl">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start ">
                <div class=" w-full text-center sm:text-left">
                  <div class="m-2">
                      <h3 class="text-base font-semibold leading-6 text-gray-900"id="modal-title">Eliminar Usuario</h3>
                      <p class="text-xs text-gray-500">
                          ¿ Estas seguro ?
                      </p>
                      <div v-if="deleteSuccess===true">
                          <p class="text-sm font-semibold text-green-700">
                            Usuario eliminado correctamente
                          </p>
                      </div>
                      <div v-else-if="deleteSuccess===false">
                        <p class="text-sm text-gray-500">
                            No se pudo eliminar el usuario
                          </p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
              <button type="button" @click="deleteHandler" :disabled="isSubmitting" class="inline-flex w-full justify-center rounded-md  disabled:bg-slate-500  bg-purple-600 px-3 py-2 text-sm font-semibold transition text-white shadow-sm hover:bg-purple-500 sm:ml-3 sm:w-auto">
                Eliminar Usuario
              </button>
              <button @click="$emit('close')" type="button"  class="mt-3 inline-flex w-full justify-centerrounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                Cancelar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue';
import { deleteUser} from '../../../api/api.js';
const props = defineProps({
    userId:{
        type:Number,
        required:true
    }
});

const deleteSuccess = ref(null);
const message = ref("");
const isSubmitting = ref(false);

async function deleteHandler(){
    console.log('Deleting user with ID:', props.userId);
        
    isSubmitting.value = true;
    const response = await deleteUser(props.userId);
    isSubmitting.value = false;

    if(response.data['success'] === 'true'){
        message.value = response.data['message'];
        deleteSuccess.value = true;
        setTimeout(() => {
            window.location.reload()
        }, 1200 );
    }else{
        message.value = response.data['message'];
        deleteSuccess.value = false;
                setTimeout(() => {
                    window.location.reload()
        }, 1200 );
    }      

};

const closeHandler = () => {
    emit('close');
};
</script>
