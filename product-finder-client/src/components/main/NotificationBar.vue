<template>
    <div :class="[ success ? 'bg-green-500' : 'bg-red-400' ,'flex text-white p-2 text-xs']">
    <img class="pr-2" src="../../assets/icons/Alerta 1.svg"></img>
    {{ message }}
    </div>
</template>

<script setup>

import {ref, defineProps} from 'vue';

const props = defineProps({
    message:{
        type:String,
        required:false,
    },
    success:{
        type:Boolean,
        required:true,
    }
});

</script>