<template>
  <div class="relative z-40">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-50 w-screen overflow-y-auto font-neering">
      <div class="flex min-h-full items-end justify-center text-center items-center">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-32 sm:w-full sm:max-w-xl">
          <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start ">
              <div class=" w-full text-center sm:text-left">
                <div class="m-2">
                    <h3 class="text-base font-semibold leading-6 text-gray-900"id="modal-title">Crear Producto</h3>
                    <p class="text-xs text-gray-500">
                        Todos los campos son obligatorios.
                    </p>
                </div>
                <div class="sm:flex sm:flex-row">
                    <div class="w-full">
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="name" id="name" name="name" type="text" placeholder="Nombre">
                                <span v-if="nameIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="sku" id="sku" name="sku" type="text" placeholder="SKU">
                                <span v-if="skuIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="description" id="description" name="description" type="text" placeholder="Description">
                                <span v-if="descriptionIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="price" id="price" name="price" type="number" min="0" placeholder="Precio">
                                <span v-if="priceIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                    </div>
                    <div class="sm:w-full rounded-sm m-2 sm:flex sm:flex-col sm:justify-evenly sm:items-center bg-slate-200">
                        <div class="">
                            <img src="../../../assets/img/Grupo 768.svg">
                        </div>
                        <div class="text-neutral-600 text-xs">
                            Agrega tu foto de perfil
                        </div>
                    </div>
                </div>
                <div class="text-xs font-semibold">
                    {{ message }}
                </div>
              </div>
              
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" @click="registerHandler()"class="inline-flex w-full justify-center rounded-md bg-purple-600 disabled:bg-slate-500  px-3 py-2 text-sm font-semibold transition text-white shadow-sm hover:bg-purple-500 sm:ml-3 sm:w-auto"  :disabled="!isFormValid || isSubmitting" >
              Crear Producto
            </button>
            <button @click="$emit('close')" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import { ref, computed, defineProps, defineEmits } from 'vue';
import { productAdd } from '../../../api/api';

const name = ref("");
const price = ref(0);
const sku = ref("");
const description = ref("");
const photos = ref("");
const productAddSuccess = ref(null);
const message = ref("");
const isSubmitting =ref(false);

// Validation
const nameIsValid = computed(() => name.value.trim() !== '');
const priceIsValid = computed(() => price.value >= 0);
const skuIsValid = computed(() => sku.value.trim() !== '');
const descriptionIsValid = computed(() => description.value.trim() !== '');
const isFormValid = computed(() => nameIsValid.value && priceIsValid.value && skuIsValid.value && descriptionIsValid.value);

async function registerHandler(){
    if(isFormValid.value){
        try{
            isSubmitting.value = true;
            const response = await productAdd(name.value, sku.value, description.value, price.value, photos.value);
            //isSubmitting.value=false;
            console.log(response);
    
            if(response.data['success'] === 'true'){
                message.value = "Producto agregado exitosamente.";
                console.log(message.value);
                productAddSuccess.value = true;
                setTimeout(() => {
                    window.location.reload()
                }, 1200 );
            }else if (response.data['success'] === 'false'){
                console.log(message.value);
                message.value  = response.data['message'] ;
                productAddSuccess.value = false;
                setTimeout(() => {
                    window.location.reload()
                }, 1200 );
            }
        }catch(error){
            message.value = "Error en la solicitud.";
            console.log(response);
            productAddSuccess.value = false;
            isSubmitting.value = false;
            setTimeout(() => {
                    window.location.reload()
                }, 1200 );
        }
    }else{
        message.value="Datos mal ingresados";
        productAddSuccess.value=false;
        setTimeout(() => {
                    window.location.reload()
                }, 1200 );
    }
};
</script>