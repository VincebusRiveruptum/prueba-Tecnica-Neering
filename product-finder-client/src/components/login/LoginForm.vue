<template>
    <div class="flex flex-col py-2">
      <form @submit.prevent="handleLogin">
        <div class="w-full py-1 text-xs">
          <input class="w-full p-2 bg-violet-100 rounded-sm" v-model="name" id="name" name="name" type="text" placeholder="Usuario" />
        </div>
        <div class="w-full py-1 text-xs">
          <input class="w-full p-2 bg-violet-100 rounded-sm" v-model="password" id="password" name="password" type="password" placeholder="Contraseña" />
        </div>
        <div class="flex flex-row justify-between items-center text-xs">
          <div class="flex flex-row py-2">
            <input v-model="rememberMe" name="rememberMe" id="rememberMe" type="checkbox" />
            <label for="rememberMe">Recuerdame</label>
          </div>
          <div class="flex flex-row py-2">
            <button @click.prevent="handleForgotPassword">¿Olvido su contraseña?</button>
          </div>
        </div>
        <div>
          <button type="submit" class="bg-purple-600 transition-colors text-xs w-full font-semibold hover:bg-purple-800 disabled:bg-gray-500 text-white font-display py-1 px-4 rounded" :disabled="isSubmitting || !isFormValid">Ingresar</button>
        </div>
        <div class="text-xs font-neering font-semibold py-1">
          <div v-if="success !== null">
            <NotificationBar :message="success ? 'Sesion iniciada exitosamente' : 'Usuario inválido'" :success="success"/>         
          </div>
        </div>
      </form>
    </div>
</template>

<script setup>
  
import { ref, computed} from 'vue';
import { useRouter } from 'vue-router';
import { login as requestLogin } from '../../api/api';
import NotificationBar from '../main/NotificationBar.vue';

const name = ref('');
const password = ref('');
const rememberMe = ref(false);
const success = ref(null);
const isSubmitting = ref(false);

const router = useRouter();

// Input validation
const nameIsValid = computed(() => name.value.trim() !== '');
const passIsValid = computed(() => password.value.trim() !== '');
const isFormValid = computed(() => nameIsValid.value && passIsValid.value );

async function handleLogin(){
  try {
    isSubmitting.value = true;
    await requestLogin(name.value, password.value);
    success.value = true;
    
    setTimeout(() => {
      router.push("/products");        
    }, 1000);

  } catch(error) {
    isSubmitting.value = false;
    console.log("fail");
    success.value = false;
  }
};

const handleForgotPassword = () => {
  // Handle forgot password functionality
};
</script>
  