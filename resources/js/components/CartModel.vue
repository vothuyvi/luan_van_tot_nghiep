<template>
    <div class="header_cart_model mt-[3.8px]">
        <h2 class="mx-auto text-3xl font-bold my-6">Giỏ hàng</h2>
        <div v-if="state.orders.length == 0" class=" flex flex-col justify-center items-center p-8 ">
            <div class="w-[6rem]"> <img src="/images/products/cart.png" alt=""></div>
            <div class="text-2xl">
                Chưa có sản phẩm
            </div>
        </div>
        <div class="cart_list p-2">
            <div v-for="(item, index) in state.orders" :key="index" class="cart_item flex gap-2 items-center">
                <div class="w-[8rem] h-[8rem] flex items-center justify-center p-2 border border-[#d9d9d9] rounded-lg">
                    <img :src="`/images/products/${item.HinhAnh}`" />
                </div>
                <div>
                    <div class="text-xl font-bold">{{ item.TenSP }}</div>
                    <div class="text-[1.2rem] font-medium">Giá: {{ formatMoney(item.GiaTien) }} đ</div>
                </div>
                <div class="text-[1.2rem] font-medium w-[8rem]">
                    <div class="whitespace-nowrap">Số lượng: {{ item.SoLuongOrder }}</div>
                </div>
                <div class="text-2xl ml-2">
                    <p @click="handelDelete(item.MaSP)">
                        <i class="fa-solid fa-trash cursor-pointer hover:text-red-600 text-sky-600"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 content-between text-black p-8" :class="state.orders.length == 0 ? 'hidden' : ''">
            <div class="text-2xl font-bold">Tổng tiền:</div>
            <div class="text-2xl font-normal text-right">{{ formatMoney(state.totalPrice) }} đ</div>
        </div>
        <div class="p-2 border-t-2">
            <div class="cart_bot_btn grid grid-cols-2 gap-10 m-6" :class="state.orders.length == 0 ? 'hidden' : ''">
                <router-link :to="{ name: 'CartView' }"><button>Xem giỏ hàng</button>
                </router-link>
                <button class="ml-auto" @click="handelCheckOut()">Thanh toán</button>

            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, onMounted, watch } from "vue";
import { getProducts } from '@/api/auth';
import { useAuthStore } from '@/stores';
import { handelDelete } from '@/utils/helper.js'
import { useRouter } from 'vue-router'
import { ElMessageBox } from 'element-plus';
const state = reactive({
    orders: [],
    localOrders: [],
    totalPrice: 0,
})
const authStore = useAuthStore();
const router = useRouter();

const formatMoney = (money) => {
    return money
        ?.toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        ?.replace("₫", "");
};

watch(
    () => authStore.refetchOrder,
    async () => {
        console.log('co thay doi:')
        await getOrder();

    },
    // { deep: true }
)

const getOrder = async () => {
    const orders = JSON.parse(localStorage.getItem('orders'));
    if (orders) {
        const products = orders;
        if (products && products.length > 0) {
            const listMaSP = products.map((item) => {
                return item.MaSP;
            })
            const localOrders = products.map((item) => {
                return { MaSP: item.MaSP, SoLuong: item.SoLuong };
            })
            state.localOrders = localOrders;
            const form = {
                listMaSP: listMaSP,
            };
            const { data: res } = await getProducts(form);
            if (res) {
                state.orders = res.data;
                state.orders.forEach(item => {
                    const itemLocal = state.localOrders.find(local => local.MaSP == item.MaSP);
                    if (itemLocal) {
                        item.SoLuongOrder = itemLocal.SoLuong
                    } else {
                        item.SoLuongOrder = 1;
                    }
                })
                getTotalPrice();
            }
        } else {
            state.orders = [];
            state.totalPrice = 0;
            authStore.orderCount = 0;
        }

    } else {
        state.orders = [];
        state.totalPrice = 0;
        authStore.orderCount = 0;
    }
}


const getTotalPrice = () => {
    let totalMoney = 0;
    let totalProduct = 0;
    state.orders.forEach(item => {
        totalMoney += Number(item.GiaTien * item.SoLuongOrder);
        totalProduct += 1;
    })
    state.totalPrice = totalMoney;
    authStore.orderCount = totalProduct;

}

const handelCheckOut = () => {
    if (authStore.isLogin) {
        router.push({
            name: 'CheckoutView',
        });
    } else {
        ElMessageBox.confirm(
            'Cần đăng nhập để thực hiện chức năng này!',
            {
                confirmButtonText: 'Đăng nhập',
                cancelButtonText: 'Cancel',
                type: "info",
            }
        )
            .then(() => {
                document.location.href = '/login'
            })
    }
}

onMounted(async () => {
    await getOrder();
})
</script>
<style lang="scss" scoped>
@import "@/style/header.scss";
</style>
