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
const { vnp_TransactionStatus, vnp_TxnRef } = route.query;

onMounted(async () => {
    if (vnp_TransactionStatus === '00') {
        const form = {
            MaDH: vnp_TxnRef,
            MaThanhToan: '01', //đã thanh toán
            MaTT: '2' //đã duyệt
        }
        const { data: res } = await updateOrder(form);
        if (res) {
            router.push({
                name: 'PaymentSuccessView',
            });
        }
    } else {
        const form = {
            MaDH: vnp_TxnRef,
            MaThanhToan: '02', //chưa thanh toán
            MaTT: '5' //đã huỷ
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