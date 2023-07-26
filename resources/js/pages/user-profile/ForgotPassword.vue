<template>
    <div v-loading="state.loading" class="container__login">
        <div class="container__login-body">
            <div class="login-body__header">
                <span>Quên mật khẩu</span>
            </div>
            <div v-if="state.error" class="text-red-600 text-xl font-medium">{{ state.error }}</div>
            <div class="login-body__center">
                <div class="login">
                    <span>Tên đăng nhập</span>
                    <input v-model="state.email" type="email" name="" id="" class="fontAwesome"
                        placeholder=" &#xf0e0;  Enter your email" />
                </div>
            </div>
            <div class="login-body__bot">
                <button @click="handelForgotPassword()">Gửi</button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { forgotPassword } from '@/api/auth';
import { useAuthStore } from '@/stores'

const authStore = useAuthStore();
const router = useRouter();
const state = reactive({
    email: '',
    password: '',
    error: '',
    loading: false,
});

const handelForgotPassword = async () => {
    try {
        const form = {
            email: state.email
        }
        state.loading = true;
        const { data: res } = await forgotPassword(form);
        state.loading = false;
        router.push({
            name: 'SentForgotPasswordView',
        });

    } catch (error) {
        state.loading = false;
        console.log(error);
        console.log(error.response.data);
        state.error = error.response.data.message;
    }
}
</script>
<style lang="scss" scoped>
@import '@/style/login.scss';
</style>