<template>
    <div class="w-[80%] mx-auto my-[2rem] bg-white text-[1.4rem]">
        <h3 class="text-center text-[3.8rem] text-sky-500 font-bold">THANH TOÁN</h3>
        <p class=" text-[1.7rem] font-[500] text-center text-sky-500 mb-[2rem]">
            <i class="fa-regular fa-window-minimize"></i>
            <i class="fa-regular fa-window-minimize"></i>
            <i class="fa-regular fa-window-minimize"></i>
        </p>
        <p class="border-b border-slate-950"></p>
        <div class="grid grid-cols-2 gap-16 pt-10">
            <div class="">
                <div class="bg-white p-8 rounded" style="box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.13)">
                    <div class="text-3xl font-medium mb-2">
                        <i class="fa-solid fa-location-dot mr-2"></i> THÔNG TIN
                        KHÁCH HÀNG
                    </div>
                    <div class="grid grid-rows-4">
                        <input v-model="state.form.TenNguoiNhan" type="text" name="name" id=""
                            class="fontAwesome p-4 border border-sky-600 mt-4 mb-4"
                            placeholder="&#xf007;  Tên người nhận" />
                        <input v-model="state.form.email" type="email" name="email" id=""
                            class="fontAwesome p-4 border border-sky-600 mt-4 mb-4" placeholder="&#xf0e0;  Email" />
                        <input v-model="state.form.SDTNguoiNhan" name="phone" id=""
                            class="fontAwesome p-4 border border-sky-600 mt-4 mb-4"
                            placeholder="&#xf095;  Số điện thoại người nhận" />
                        <input v-model="state.form.DiaChiNguoiNhan" type="text" name="address" id=""
                            class="fontAwesome p-4 border border-sky-600 mt-4 mb-4"
                            placeholder="&#xf3c5;  Địa chỉ nhận hàng" />
                    </div>
                </div>

                <div class="bg-white p-8 rounded mt-6" style="box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.13)">
                    <div class="text-3xl font-medium mb-4">
                        <i class="fa-solid fa-money-bill-1-wave mr-2"></i> HÌNH
                        THỨC THANH TOÁN
                    </div>
                    <div class="grid grid-cols-1 gap-6 mt-12 mb-4">
                        <div class="flex">
                            <input v-model="state.form.MaPT" type="radio" name="pay" id="money" value="PTOFF" />
                            <label for="money"
                                class="block p-4 bg-sky-600 text-2xl font-medium text-white ml-5 rounded-md w-[27rem] cursor-pointer">
                                <i class="fa-solid fa-basket-shopping "></i>
                                Thanh toán khi nhận hàng</label>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex">
                                <input v-model="state.form.MaPT" type="radio" name="pay" id="vnpay" value="PTOL" />
                                <label for="vnpay"
                                    class="block p-4 bg-lime-600 text-2xl font-medium text-white ml-5 rounded-md w-[27rem] cursor-pointer">
                                    <i class="fa-brands fa-paypal"></i> Thanh
                                    toán trực tuyến với VNPAY
                                </label>
                            </div>
                        </div>
                        <div class="flex">
                            <input v-model="state.form.MaPT" type="radio" name="pay" id="momo" value="PTOLMOMO" />
                            <label for="momo"
                                class="block p-4 bg-pink-600 text-2xl font-medium text-white ml-5 rounded-md w-[27rem] cursor-pointer">
                                <i class="fa-brands fa-paypal"></i> Thanh
                                toán trực tuyến với MOMO
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 rounded" style="box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.13)">
                <div class="flex justify-between items-center font-medium mb-2">
                    <div class="text-3xl">
                        <i class="fa-solid fa-cart-flatbed-suitcase mr-2"></i>
                        THÔNG TIN ĐƠN HÀNG
                    </div>
                    <router-link :to="{ name: 'CartView' }">
                        <div class="border p-2 rounded-md hover:bg-red-600 hover:text-white cursor-pointer">
                            <i class="fa-regular fa-pen-to-square"></i> Chỉnh
                            sửa
                        </div>
                    </router-link>
                </div>
                <div class="header_cart_model">
                    <div class="cart_list">
                        <div class="cart_item">
                            <table width="100%">

                                <tr v-for="(item, index) in state.orders" :key="index">
                                    <td class="w-[12rem]">
                                        <img :src="`/images/products/${item.HinhAnh}`" />
                                    </td>
                                    <td class="text-2xl font-medium w-[22.5rem] text-center">
                                        {{ item.TenSP }}
                                    </td>
                                    <td class="text-red-500 font-medium text-2xl text-right">
                                        x{{ item.SoLuongOrder }}
                                        <!-- ...{{ item.SoLuong }} -->
                                    </td>
                                    <td class="text-red-500 font-medium text-2xl  text-right">
                                        {{ formatMoney(item.GiaTien) }} đ
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center border-b p-5">
                    <div class="text-3xl font-medium">Tạm tính</div>
                    <div class="text-4xl font-medium text-red-500">
                        {{ formatMoney(state.totalPriceTmp) }} đ
                    </div>
                </div>

                <div>
                    <div v-if="state.totalPriceTmp >= state.khuyenMai.DieuKienApDung"
                        class="flex justify-between items-center border-b p-5">
                        <div class="text-3xl font-medium text-sky-500">
                            Khuyến mãi {{ state.khuyenMai.PhanTram }} %</div>
                        <div class="text-4xl font-medium text-sky-500">
                            - {{ formatMoney((state.totalPriceTmp * state.khuyenMai.PhanTram) / 100) }} đ
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center border-b p-5">
                    <div class="text-3xl font-bold">Thành tiền</div>
                    <div class="text-4xl font-bold text-red-700">
                        {{ formatMoney(state.totalPrice) }} đ
                    </div>
                </div>
                <textarea v-model="state.form.GhiChu" class="border-sky-600 mt-4 mb-4 p-4 border fontAwesome w-full"
                    rows="3" name="note_customer" placeholder=" &#xf075;  Ghi chú"></textarea>
                <div v-if="state.orders.length === 0"
                    class="p-5 hover:bg-sky-500 border border-sky-600 rounded-lg text-center font-bold text-3xl cursor-pointer hover:text-white">
                    <button @click="onClickCheckOut()" disabled class="cursor-not-allowed opacity-50">Thanh toán</button>
                </div>
                <div v-else
                    class="p-5 hover:bg-sky-500 border border-sky-600 rounded-lg text-center font-bold text-3xl cursor-pointer hover:text-white"
                    @click="onClickCheckOut()">
                    <button>Thanh toán</button>
                </div>



            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, onMounted, watch, ref } from "vue";
import { getProducts, checkOut, khuyenMai, payment, paymentMoMo } from '@/api/auth';
import { useAuthStore } from '@/stores';
import { useRoute } from 'vue-router'
import { ElMessage } from 'element-plus'

const state = reactive({
    orders: [],
    localOrders: [],
    totalPriceTmp: 0,
    totalPrice: 0,
    phuongThucThanhToan: [],
    form: {
        email: '',
        TenNguoiNhan: '',
        DiaChiNguoiNhan: '',
        SDTNguoiNhan: '',
        GhiChu: '',
        MaPT: 'PTOFF',
        listSP: [],
    },
    khuyenMai: {},
    listKM: []
})
const authStore = useAuthStore();

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
    // console.log('order sao ko ra:', orders)
    // console.log('user:', authStore.user.MaKH)
    if (orders) {
        const products = orders;
        console.log('masp ne', products);
        if (products && products.length > 0) {
            const listMaSP = products.map((item) => {
                return item.MaSP;
            })
            const localOrders = products.map((item) => {
                return { MaSP: item.MaSP, SoLuong: item.SoLuong };
            })
            state.localOrders = localOrders;
            // console.log('localOrders:', localOrders)
            // console.log('list MaSP', listMaSP);
            const form = {
                listMaSP: listMaSP,
            };
            const { data: res } = await getProducts(form);
            // console.log('data', res);
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
                // console.log('state.orders:', state.orders)
                getTotalPrice();
            }
        } else {
            state.orders = [];
            state.totalPrice = 0;
            state.totalPriceTmp = 0;
            authStore.orderCount = 0;
        }

    } else {
        state.orders = [];
        state.totalPrice = 0;
        state.totalPriceTmp = 0;
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
    state.totalPriceTmp = totalMoney
    // ap dung khuyen mai neu co
    const listKM = state.listKM.filter(val => val.DieuKienApDung <= state.totalPriceTmp)
    if (listKM && listKM.length > 0) {
        state.khuyenMai = listKM.reduce((a, b) => {
            return (a.PhanTram > b.PhanTram) ? a : b
        });
    }
    if (state?.khuyenMai?.PhanTram) {
        state.totalPrice = totalMoney - ((state.totalPriceTmp * state.khuyenMai.PhanTram) / 100);
    } else {
        state.totalPrice = totalMoney
    }
    authStore.orderCount = totalProduct;

}
const checkValidate = () => {
    if (state.form.TenNguoiNhan === '') {
        ElMessage({
            message: 'Vui lòng nhập họ tên người nhận.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (state.form.email === '') {
        ElMessage({
            message: 'Vui lòng nhập email.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (!isEmailValid(state.form.email)) {
        ElMessage({
            message: 'Email không đúng định dạng',
            type: 'error',
            grouping: true,
        })
        return false;
    }

    if (state.form.SDTNguoiNhan === '') {
        ElMessage({
            message: 'Vui lòng nhập SĐT người nhận.',
            type: 'error',
            grouping: true,
        })
        return false;
    }
    if (state.form.DiaChiNguoiNhan === '') {
        ElMessage({
            message: 'Vui lòng nhập địa chỉ người nhận.',
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

const onClickCheckOut = async () => {
    try {
        const listSP = [];
        state.orders.forEach(item => {
            let totalMoney = Number(item.GiaTien * item.SoLuongOrder);
            if (item.SoLuongOrder <= item.SoLuong) {
                listSP.push({
                    MaSP: item.MaSP,
                    total: totalMoney,
                    quantity: item.SoLuongOrder
                })
                state.form.listSP = listSP;
            } else {
                ElMessage({
                    message: 'Sản phẩm không đủ số lượng.',
                    type: 'error',
                    grouping: true,
                })
            }
        })
        state.form.TongTienDonHang = state.totalPrice;
        state.form.MaKM = state.khuyenMai.MaKM;
        if (checkValidate()) {
            if (state.form.listSP.length != 0) {
                const { data: res } = await checkOut(state.form)
                if (state.form.MaPT === 'PTOL') {
                    handlePayment(res);
                }
                else if (state.form.MaPT === 'PTOLMOMO') {
                    handlePaymentMoMo(res);
                }
                ElMessage({
                    message: 'Đặt hàng thành công.',
                    type: 'success',
                    grouping: true,
                })
                state.form = {
                    email: '',
                    TenNguoiNhan: '',
                    DiaChiNguoiNhan: '',
                    SDTNguoiNhan: '',
                    GhiChu: '',
                    MaPT: 'PTOFF',
                    listSP: [],
                }
                state.orders = [];
                state.totalPrice = 0;
                handelDeleteCart();
            }
        }
    } catch {
        ElMessage({
            message: 'Đặt hàng không thành công, bạn vui lòng thử lại!',
            type: 'error',
            grouping: true,
        })
    }
}
const handelDeleteCart = () => {
    const orders = JSON.parse(localStorage.getItem('orders'));
    if (orders) {
        localStorage.removeItem('orders');
        authStore.onRefetchOrder();
    }

}

const getKhuyenMai = async () => {
    const { data: res } = await khuyenMai()
    if (res?.data) {
        state.listKM = res.data
    }

}

const handlePayment = async (order) => {
    // console.log('payment', order);
    const form = {
        TongTien: order.data.TongTienDonHang,
        MaDH: order.data.MaDH
    }
    const { data: res } = await payment(form);
    console.log('payment', res);
    location.href = res;

}

const handlePaymentMoMo = async (order) => {
    console.log('payment momo:', order);
    const form = {
        MaDH: order.data.MaDH,
        TongTienDonHang: order.data.TongTienDonHang,
    }
    const { data: res } = await paymentMoMo(form);
    console.log('payment momo', res.data.payUrl);
    // location.href = res.data.payUrl;
}

onMounted(async () => {
    await getKhuyenMai();
    await getOrder();
})

</script>
<style lang="scss" scoped>
.fontAwesome {
    font-family: Helvetica, "FontAwesome", sans-serif;
}

td {
    border-bottom: 1px solid black;
}

img {
    width: 12rem;
    height: 11rem;
    object-fit: cover;
}
</style>
