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
                    <h3 class="text-base font-semibold leading-6 text-gray-900"id="modal-title">Crear Usuario</h3>
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
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="email" id="email" name="email" type="email" placeholder="Email">
                                <span v-if="emailIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="emailConf" id="confirmEmail" name="confirmEmail" type="confirmEmail" placeholder="Confirmar Email">
                                <span v-if="emailConfValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="password" id="password" name="password" type="password" placeholder="Contraseña">
                                <span v-if="passIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <img src="../../../assets/icons/Check%201.svg">
                                </span>
                            </input>
                        </div>
                        <div class="m-2 text-xs relative">
                            <input class="w-full p-2 sm:my-1 bg-violet-100 rounded-sm" v-model="passwordConfirmation" id="passwordConfirmation" name="passwordConfirmation" type="password" placeholder="Confirmar Contraseña">
                                <span v-if="passConfValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
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
              Crear Usuario
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
import { register } from '../../../api/api';

const name = ref("");
const email = ref("");
const emailConf = ref("");
const password = ref("");
const passwordConfirmation = ref("");
const registrationSuccess = ref(null);
const message = ref("");
const isSubmitting =ref(false);

// Validation
const nameIsValid = computed(() => name.value.trim() !== '');
const emailIsValid = computed(() => email.value.trim() !== '');
const emailConfValid = computed(() => ((emailConf.value.trim() !== '') && (emailConf.value === email.value)));
const passIsValid = computed(() => password.value.trim() !== '');
const passConfValid = computed(() => ((passwordConfirmation.value.trim() !== '') && (passwordConfirmation.value === password.value)));
const isFormValid = computed(() => nameIsValid.value && emailConfValid.value && passConfValid.value);

async function registerHandler(){
    console.log(isFormValid.value)
    if(isFormValid.value){
        try{
            isSubmitting.value = true;
            const response = await register(name.value, email.value, password.value, passwordConfirmation.value);
            isSubmitting.value=false;
            console.log(response);
    
            if(response.data['success'] === 'true'){
                message.value = "Usuario registrado exitosamente.";
                console.log(message.value);
                registrationSuccess.value = true;
            }else if (response.data['success'] === 'false'){
                console.log(message.value);
                message.value = "Error en la solicitud 1.";
                registrationSuccess.value = false;
            }
        }catch(error){
            message.value = "Error en la solicitud :" + response.data['message'];
            console.log(message.value);
            registrationSuccess.value = false;
            isSubmitting.value = false;
        }
    }else{
        message.value="Corrige tus datos";
        registrationSuccess.value=false;
    }
};
</script>