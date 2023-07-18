import { defineStore } from 'pinia';
export const useUser = defineStore('userId', {
    state: () => ({
        user: {},
    }),
    actions: {
        /**
         * setDataUser set data user
         * @author: Vii :3
         */
        setDataUser(data) {
            this.user = data;
        },
    },
});
