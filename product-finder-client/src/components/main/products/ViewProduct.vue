<template>
    <div v-if="product != null">

        <div class="flex flex-row justify-between items-center w-full p-2">
            <div class="flex flex-row items-center">
                <h1 class="font-neering font-semibold text-md">{{ product.name }}</h1>
            </div>
        </div>
        <div class="flex flex-col w-full shadow-lg rounded-sm bg-white font-neering">

            <div class="flex flex-row justify-between items-center p-4 w-full">
                <div class="px-2">
                    <button
                        @click="handleGoBack"
                        :disabled="isSubmitting" class="bg-purple-600 text-xs font-neering font-semibold transition-colors hover:bg-purple-800 disabled:bg-slate-500 text-white font-display py-2 px-8 rounded"
                        >
                        Volver
                    </button>
                </div>
                <div class="px-2">
                    <button
                        @click="handleModifyModal"
                        :disabled="isSubmitting" class="bg-purple-600 text-xs font-neering font-semibold transition-colors hover:bg-purple-800 disabled:bg-slate-500 text-white font-display py-2 px-8 rounded"
                        >
                        Modificar
                    </button>
                </div>  
                <div v-if="isModifyModalOpen">
                    <ModifyProductModal :product="product" @close="isModifyModalOpen = false" />
                </div>
            </div>
            <hr>
            <div class="flex flex-col sm:flex-row">
                <div class="sm:flex sm:flex-col sm:justify-between p-8 w-full">
                    <div>
                        <h1 class="font-semibold">Desripción</h1>
                        <p class="text-sm">
                            {{  product.description }}
                        </p>
                        <br>
                        <p><b>Precio</b> : ${{ product.price }}</p>
                        <p><b>SKU</b> : {{ product.sku }}</p>
                    </div>
                    <div>
                        <div class="flex flex-row justify-between">
                            
                            <div class="flex items-center">
                                <h1><b>Stock :</b> {{ product.stock }}</h1>
                            </div>
                            <div class="flex flex-row items-center">
                                <div class="pr-2">
                                    <h1 class="font-semibold">Disponibilidad</h1>
                                </div>
                                <div v-if="product.available">
                                    <img :src="checkIcon"/>
                                </div>
                            </div>

                        </div>
        
                    </div>

                </div>
                <div class="text-sm w-full p-8 ">
                    <div class="flex flex-col text-center p-8 bg-slate-200 rounded-md">
                        <img :src="photoPlaceHolder">
                    </div>
                </div>
            </div>
 


        </div>    
    </div>
    
    <div>
        
    </div>
</template>

<script setup>

import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { getProduct } from "../../../api/api";
import ModifyProductModal from "@/components/main/products/ModifyProductModal.vue";
import checkIcon from "@/assets/icons/Check 1.svg";
import photoPlaceHolder from "@/assets/img/Grupo 768.svg"

const route = useRoute();
const router = useRouter();

const isModifyModalOpen = ref(null);
const product = ref(null);
const isSubmitting = ref(false);

function handleModifyModal() {
    isModifyModalOpen.value = true;
}

function handleGoBack(){
    router.push('/products');
}

async function fetchProduct(){
    try{
        const response = await getProduct(route.params.productId);
        product.value = response.data['content'];
    }
    catch(e){
        console.error(e);
    }
};

fetchProduct();

</script>