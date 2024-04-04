<template>
    <div v-if="yesno">
        <span class="inline-flex items-center rounded-md bg-sky-400 px-6 py-1 text-sm font-light text-white font-medium">{{yestext }}</span>
      </div>
      <div v-else>
        <span class="inline-flex items-center rounded-md bg-slate-200 px-6 py-1 text-sm font-light text-white font-medium">{{ notext }}</span>      
    </div>
</template>    

<script setup>

const props = defineProps({
    yesno:{
        type:Number,
        required:true,
    },
    notext:{
        type:String,
        required:true
    },
    yestext:{
        type:String,
        required:true,
    }
});

</script>
