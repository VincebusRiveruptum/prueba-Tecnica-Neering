<script setup>

import { ref,computed } from 'vue';
import { whoami } from "../../api/api";
import { useUserStore } from "../../stores/userStore.js"

const users = useUserStore();

async function fetchMyInfo(){
    const response = await whoami();
    const content = response.data;

    if(content){
        users.setMe(content);
    }
}

fetchMyInfo();

</script>

<template>
    <nav class="relative flex flex-row w-full justify-between  items-center p-2 shadow-md z-40">
        <div class="flex flex-row items-center">
            <div class="flex flex-row items-center px-4">
                <img src="../../assets/logos/Grupo 36.svg" alt="Neering"></img>
            </div>
            <div class="flex flex-row items-center px-4">
                <h1 class="font-neering text-md font-semibold">TEST NEERING</h1>
            </div>
        </div>
        <div class="flex flex-row px-4">
            <div class="flex flex-row px-4">
                <img src="../../assets/icons/Notificación.svg" alt="bell"></img>
            </div>
            <div class="flex flex-row px-4">        
                <img src="../../assets/icons/Elipse 16.png" alt="elipse"></img>
            </div>
            <div class="flex flex-row items-center px-4">
                <h1 class="font-neering font-semibold ">{{ users.getMe.name }}</h1>
            </div>
        </div>
    </nav>
</template>
