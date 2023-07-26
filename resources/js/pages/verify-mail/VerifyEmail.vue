<template>
    <div v-loading="state.loading"></div>
</template>
<script setup>
import { reactive, onMounted } from "vue";
import { useRoute, useRouter } from 'vue-router'
import { ElMessage } from 'element-plus'
import { verifyEmail } from '@/api/auth';

const route = useRoute()
const router = useRouter();
const { token } = route.params
const state = reactive({
    loading: true,
})

const getVerifyEmail = async () => {
    try {
        const { data: res } = await verifyEmail(token)
        if (res) {
            state.loading = false;
            ElMessage({
                message: 'Xác thực tài khoản thành công!',
                type: 'success',
                grouping: true,
            })
            router.push({
                name: 'LoginView',
            });
        }
    } catch {
        state.loading = false;
        router.push({
            name: 'VerifyEmailErrorView',
        });
    }


}

onMounted(async () => {
    await getVerifyEmail();
})
</script>