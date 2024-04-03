import {ref, computed} from 'vue';
import { defineStore } from 'pinia';

export const useUserStore = defineStore('users', () => {
    const me = ref([]);
    const getMe = computed( () => me.value);
    function setMe(meData){
        me.value = meData;
    }
    return{
        getMe, setMe
    }
});