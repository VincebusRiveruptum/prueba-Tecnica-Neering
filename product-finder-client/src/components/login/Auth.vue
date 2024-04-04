
<template>
  <div class="sm:flex sm:flex-row sm:w-full font-neering items-center bg-slate-100">
    <div class="flex flex-row justify-center">
      <img class="sm:h-screen object-cover h-40 w-full " src="../../assets/img/Grupo 761.png" alt="neering" />
    </div>
    <div class="flex flex-col sm:flex-row h-full justify-center items-center w-full">
        <div class="p-4 sm:w-auto w-full" >
            <div class="flex flex-col pb-4">
                <div class="flex justify-center sm:justify-normal flex-row ">
                  <img
                    class="w-16 h-16"
                    src="../../assets/logos/Grupo 935.svg"
                    alt="neering-logo"
                  />
                </div>
                <div class="flex flex-col text-center sm:text-start py-2">
                  <h1 class="font-semibold text-xl">¡Bienvenidos a Neering!</h1>
                  <h1 class="font-extralight text-sm">
                    Desarrolla esta plataforma a la perfección.
                  </h1>
                </div>
            </div>
            <div class="flex flex-row pb-4">
              <div class="px-2">
                <button
                  @click="isLogin"
                  class="hover:text-neutral-800 transition-colors font-bold text-xs text-neutral-400 py-2 px-2 border-b-2 border-purple-800-opacity-5 hover:border-purple-600 rounded" :class="{'border-purple-600 rounded text-neutral-800' : !isLoginOrRegister }" 
                >
                  Iniciar sesión
                </button>
              </div>
              <div class="px-2">
                <button
                  @click="isRegister"
                  class="hover:text-neutral-800 transition-colors font-bold text-xs text-neutral-400 py-2 px-2 border-b-2 border-purple-800-opacity-5 hover:border-purple-600 rounded" :class="{'border-purple-600 rounded  text-neutral-800' : isLoginOrRegister }"
                >
                  Registrarse
                </button>
              </div>
            </div>
            <div>
              <div class="py-2" v-if="isLoginOrRegister">
                <RegisterForm />
              </div>
              <div v-else>
                <LoginForm />
              </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import RegisterForm from "./RegisterForm.vue";
import LoginForm from "./LoginForm.vue";

const isLoginOrRegister = ref(false);

const isLogin = () => {
  isLoginOrRegister.value = false;
};

const isRegister = () => {
  isLoginOrRegister.value = true;
};
</script>