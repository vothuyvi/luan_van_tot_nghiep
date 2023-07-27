<template>
    <div v-loading.fullscreen.lock="true">
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { useRouter, useRoute } from 'vue-router'
import { updateOrder } from '@/api/auth';

const router = useRouter();
const route = useRoute();
const { resultCode, orderId } = route.query;

console.log('mã đơn hàng:', orderId);
console.log(orderId.slice(-3));
onMounted(async () => {
    if (resultCode === '0') {
        const form = {
            MaDH: orderId.slice(-3),
            MaThanhToan: '01',//đã thanh toán
            MaTT: '2'// đã duyệt
        }
        const { data: res } = await updateOrder(form);
        if (res) {
            router.push({
                name: 'PaymentSuccessView',
            });
        }
    } else {
        const form = {
            MaDH: orderId.slice(-3),
            MaThanhToan: '02',//chưa thanh toán
            MaTT: '5'// đã huỷ
        }
        const { data: res } = await updateOrder(form);
        if (res) {
            router.push({
                name: 'PaymentErrorView',
            });
        }
    }
})

</script>