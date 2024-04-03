<template>
    <div>
        <form @submit.prevent="registerHandler">
            <div class="flex flex-col pb-4">
                <div class="py-1 text-xs relative">
                    <input class="w-full p-2 bg-violet-100 rounded-sm" v-model="name" id="name" name="name" type="text" placeholder="Nombre">
                    <span v-if="nameIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <img src="../../assets/icons/Check%201.svg">
                    </span>
                </div>
                <div class="py-1 text-xs relative">
                    <input class="w-full p-2 bg-violet-100 rounded-sm" v-model="email" id="email" name="email" type="emai" placeholder="Email">
                    <span v-if="emailIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <img src="../../assets/icons/Check%201.svg">
                    </span>
                </div>
                <div class="py-1 text-xs relative">
                    <input class="w-full p-2 bg-violet-100 rounded-sm" v-model="password" id="password" name="password" type="password" placeholder="Contraseña">
                    <span v-if="passIsValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <img src="../../assets/icons/Check%201.svg">
                    </span>
                </div>
                <div class="py-1 text-xs relative">
                    <input class="w-full p-2 bg-violet-100 rounded-sm" v-model="passwordConfirmation" id="passwordConfirmation" name="passwordConfirmation" type="password" placeholder="Confirmar Contraseña">
                    <span v-if="passConfValid" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <img src="../../assets/icons/Check%201.svg">
                    </span>
                </div>
            </div>
            <div class="py-1 font-neering text-xs font-semibold">
                <div class="py-1 text-xs w-full">
                    <button type="submit" class="bg-purple-600 w-full text-xs font-semibold transition-colors hover:bg-purple-800 disabled:bg-gray-500 text-white font-display py-1 px-4 rounded" :disabled="isSubmitting || !isFormValid">Registrar</button>
                </div>

                <div v-if="registrationSuccess !== null">
                    <NotificationBar :message="success ? 'Sesion iniciada exitosamente' : message" :success="registrationSuccess"/>  
                </div>                
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { register } from '../../api/api';
import NotificationBar from '../main/NotificationBar.vue';

const name = ref("");
const email = ref("");
const password = ref("");
const passwordConfirmation = ref("");
const registrationSuccess = ref(null);
const message = ref("");
const isSubmitting =ref(false);

// Validation
const nameIsValid = computed(() => name.value.trim() !== '');
const emailIsValid = computed(() => email.value.trim() !== '');
const passIsValid = computed(() => password.value.trim() !== '');
const passConfValid = computed(() => ((passwordConfirmation.value.trim() !== '') && (passwordConfirmation.value === password.value)));
const isFormValid = computed(() => nameIsValid.value && emailIsValid.value && passConfValid.value);

async function registerHandler(){

    if(nameIsValid && emailIsValid && passConfValid){
        try{
            isSubmitting.value = true;
            const response = await register(name.value, email.value, password.value, passwordConfirmation.value);
            isSubmitting.value=false;
            console.log(response);
    
            if(response.data['success'] === 'true'){
                message.value = "Usuario se ha registrado correctamente."
                console.log(message.value);
                registrationSuccess.value = true;
            }else if (response.data['success'] === 'false'){
                console.log(message.value);
                message.value = "Error en la solicitud 1.";
                registrationSuccess.value = false;
            }
        }catch(error){
            message.value = "Error en la solicitud 2." + error;
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

