<template>
    <div class="container__login">
        <div class="container__login-body">
            <div class="login-body__header">
                <span> Đăng ký thành viên</span>
            </div>
            <div v-if="state.error" class="text-red-600 text-xl font-medium">
                <div v-for="(key, value) in state.error" :key="key">
                    <div v-for="(item, index) in state.error[value]" :key="index">
                        {{ item }}
                    </div>
                </div>
            </div>
            <div class="login-body__center">
                <div class="login">
                    <span>Tên đăng nhập </span>
                    <input v-model="state.email" type="mail" name="" id="" class="fontAwesome"
                        placeholder=" &#xf0e0;  Enter your email" />
                </div>
                <div class="login">
                    <span>Mật khẩu </span>
                    <input v-model="state.password" type="password" class="fontAwesome"
                        placeholder=" &#xf023;  Enter your password" />
                </div>
                <div class="login">
                    <span>Xác nhận mật khẩu </span>
                    <input v-model="state.password_confirmation" type="password" class="fontAwesome"
                        placeholder=" &#xf023;  Confirm your password" />
                </div>
            </div>
            <div class="login-body__bot">
                <button @click="handleRegister()">Đăng ký</button>
                <div class="login-body-bot__signup">
                    <div class="text-xl text-black-600 mt-3">
                        Bạn đã có tài khoản?
                        <router-link :to="{ name: 'LoginView' }">
                            <b class="text-sky-500 hover:text-red-600">Đăng nhập</b></router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>
<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { ElMessage, ElMessageBox } from 'element-plus'
import { register } from '@/api/auth';

const router = useRouter();
const state = reactive({
    email: '',
    password: '',
    password_confirmation: '',
    error: '',
});

const checkValidate = () => {
    if (state.email === '') {
        ElMessage({
            message: 'Vui lòng nhập email.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (!isEmailValid(state.email)) {
        ElMessage({
            message: 'Email không đúng định dạng',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (state.password === '') {
        ElMessage({
            message: 'Vui lòng nhập password.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (state.password_confirmation === '') {
        ElMessage({
            message: 'Vui lòng nhập xác nhận password.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    return true;
}

const isEmailValid = (email) => {
    const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


const handleRegister = async () => {
    try {
        const form = {
            email: state.email,
            password: state.password,
            password_confirmation: state.password_confirmation,
        };

        if (checkValidate()) {
            const { data: user } = await register(form);
            state.error = null;
            ElMessage({
                message: 'Đăng ký tài khoản thành công!',
                type: 'success',
                grouping: true,
            });
            router.push({
                name: 'LoginView',
            });
        }


    } catch (error) {
        console.log(error);
        console.log(error.response.data);
        state.error = error.response.data.errors;
    }
};


</script>
<style lang="scss" scoped>
@import "@/style/login.scss";
</style>
