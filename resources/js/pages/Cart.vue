<template>
    <div class="body_cart">
        <h3>GIỎ HÀNG</h3>
        <p class="">
            <i class="fa-regular fa-window-minimize"></i>
            <i class="fa-regular fa-window-minimize"></i>
            <i class="fa-regular fa-window-minimize"></i>
        </p>
        <div v-if="state.orders.length == 0" class=" flex flex-col justify-center items-center p-8 ">
            <div> <img src="/images/products/cart.png" alt=""></div>
            <div class="text-3xl font-medium my-4"> Giỏ hàng của bạn còn trống!</div>
            <router-link :to="{ name: 'ProductView' }">
                <div
                    class="border-2 py-3 px-8 mt-2 rounded-2xl text-2xl font-bold border-sky-500 hover:bg-sky-500 hover:text-white cursor-pointer">
                    <button>Mua ngay</button>

                </div>
            </router-link>


        </div>
        <table :class="state.orders.length == 0 ? 'hidden' : ''">
            <tr className="tr1">
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th className="quantity">Số lượng</th>
                <th>Thành tiền</th>
                <th>Xoá</th>
            </tr>
            <tr v-for="(item, index) in state.orders" :key="index" class="tr2">
                <td>
                    <img :src="`/images/products/${item.HinhAnh}`" />
                </td>
                <td>{{ item.TenSP }}</td>
                <td>{{ formatMoney(item.GiaTien) }} đ</td>

                <td class="quantity">
                    <button v-if="item.SoLuongOrder === 1" disabled class="cursor-not-allowed opacity-50">-</button>
                    <button v-else @click="handelQuantity(item, 'MINUS')">-</button>
                    {{ item.SoLuongOrder }}
                    <button @click="handelQuantity(item, 'PLUS')">+</button>
                </td>
                <td>{{ formatMoney(item.SoLuongOrder * item.GiaTien) }} đ</td>
                <td class="delete">
                    <p @click="handelDelete(item.MaSP)"><i class="fa-solid fa-trash"></i></p>
                </td>
            </tr>
            <tr class="tr3">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="td_tt">Tổng tiền:</td>
                <td class="td_price">{{ formatMoney(state.totalPrice) }} đ</td>
            </tr>
            <tr class="tr3">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="td_btn">
                    <router-link :to="{ name: 'ProductView' }">
                        <button>Xem thêm sản phẩm</button>
                    </router-link>
                </td>
                <td class="td_btn">

                    <button class="ml-12" @click="handelCheckOut()">Thanh toán</button>

                </td>
            </tr>
        </table>
        <div class="body_cart_bot"></div>
    </div>
</template>
<script setup>
import { reactive, onMounted, watch } from "vue";
import { getProducts } from '@/api/auth';
import { useAuthStore } from '@/stores';
import { useRouter } from 'vue-router';
import { handelDelete } from '@/utils/helper.js'
import { ElMessageBox } from 'element-plus';

const state = reactive({
    orders: [],
    localOrders: [],
    totalPrice: 0,
    listMaSP: [],
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
watch(
    () => authStore.user,
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
        // console.log('masp ne', products);
        if (products && products.length > 0) {
            const listMaSP = products.map((item) => {
                return item.MaSP;
            })
            const localOrders = products.map((item) => {
                return { MaSP: item.MaSP, SoLuong: item.SoLuong };
            })
            state.localOrders = localOrders;
            state.listMaSP = listMaSP;
            // console.log('localOrders:', localOrders)
            // console.log('list MaSP', listMaSP);
            const form = {
                listMaSP: listMaSP,
            };
            const { data: res } = await getProducts(form);
            console.log('data', res);
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
                console.log('state.orders:', state.orders)
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
    console.log('tong tien', totalMoney);
    state.totalPrice = totalMoney;
    authStore.orderCount = totalProduct;

}


const handelQuantity = (item, type) => {
    console.log('sanpham', item.MaSP);
    console.log('type', type)
    const orders = JSON.parse(localStorage.getItem('orders'));
    if (orders) {
        const indexProduct = orders.findIndex(order => order.MaSP == item.MaSP);
        if (indexProduct !== -1) {
            if (type === 'PLUS') {
                orders[indexProduct].SoLuong += 1;
            } else {
                orders[indexProduct].SoLuong -= 1;
            }
        }
    } localStorage.setItem('orders', JSON.stringify(orders))

    authStore.onRefetchOrder();
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
@import "@/style/cart.scss";
</style>
