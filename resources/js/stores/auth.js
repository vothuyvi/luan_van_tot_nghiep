import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: {},
        isLogin: false,
        refetchOrder: 0,
        orderCount: 0,
    }),
    actions:{
        onRefetchOrder() {
            this.refetchOrder += 1;
        },
    }

}) 

