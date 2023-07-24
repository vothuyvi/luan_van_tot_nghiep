<template>
    <div v-loading="state.loading" class="container__login">
        <div class="container__login-body">
            <div class="login-body__header">
                <span> Khôi phục mật khẩu</span>
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
                <button @click="handleResetPassword()">Cập nhật</button>

            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, onMounted } from "vue";
import { useRoute, useRouter } from 'vue-router'
import { ElMessage } from 'element-plus'
import { resetPassword } from '@/api/auth';

const route = useRoute()
const router = useRouter();
const { token } = route.params
const state = reactive({
    password: '',
    password_confirmation: '',
    error: '',
    loading: false,
})

const checkValidate = () => {
    if (state.password === '') {
        ElMessage({
            message: 'Vui lòng nhập mật khẩu.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (state.password_confirmation === '') {
        ElMessage({
            message: 'Vui lòng nhập xác nhận mật khẩu.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    return true;
}

const handleResetPassword = async () => {
    try {
        const form = {
            token: token,
            password: state.password,
            password_confirmation: state.password_confirmation,
        };
        if (checkValidate()) {
            state.loading = true;
            const { data: res } = await resetPassword(form)
            state.error = null;
            state.loading = false;
            ElMessage({
                message: 'Thay đổi mật khẩu thành công!',
                type: 'success',
                grouping: true,
            })
            router.push({
                name: 'LoginView',
            });

        }
    } catch {
        router.push({
            name: 'VerifyEmailErrorView',
        });
    }


}

</script>
<style lang="scss" scoped>
@import "@/style/login.scss";
</style>