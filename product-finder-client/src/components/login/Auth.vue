
<template>
  <div class="flex flex-row w-full font-neering bg-slate-100">
    <div class="flex flex-row">
      <img class="h-screen w-full" src="../../assets/img/Grupo 761.png" alt="neering" />
    </div>
    <div class="flex flex-row justify-center w-full">
      <div class="flex flex-col justify-center">
        <div class="" >
            <div class="flex flex-col pb-4">
                <div class="flex flex-row py-4">
                  <img
                    class="w-16 h-16"
                    src="../../assets/logos/Grupo 935.svg"
                    alt="neering-logo"
                  />
                </div>
                <div class="flex flex-col py-2">
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