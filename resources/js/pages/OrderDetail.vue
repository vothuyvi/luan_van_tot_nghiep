<template>
    <div v-loading="state.loading" class="body_cart">
        <h3>CHI TIẾT ĐƠN HÀNG</h3>
        <p class="">
            <i class="fa-regular fa-window-minimize"></i>
            <i class="fa-regular fa-window-minimize"></i>
            <i class="fa-regular fa-window-minimize"></i>
        </p>
        <div v-if="state.orderDetail.MaTT === '1'" class="text-orange-600 font-bold text-4xl p-6 bg-[#fffcf5] box">
            <span class="px-2 py-1 rounded-full border-2 border-orange-600 mr-2"><i
                    class="fa-regular fa-note-sticky"></i></span>
            <span>
                ĐANG CHỜ DUYỆT</span>
        </div>
        <div v-if="state.orderDetail.MaTT === '2'" class="text-green-600 font-bold text-4xl p-6 bg-[#fffcf5] box">
            <span class="px-2 py-1 rounded-full border-2 border-green-600 mr-2"><i
                    class="fa-solid fa-envelope-open-text"></i></span>
            <span>
                ĐÃ DUYỆT ĐƠN</span>
        </div>
        <div v-if="state.orderDetail.MaTT === '3'" class="text-green-600 font-bold text-4xl p-6 bg-[#fffcf5] box">
            <span class="p-2 rounded-full border-2 border-green-600"><i class="fa-solid fa-truck"></i></span> <span>ĐƠN HÀNG
                ĐANG
                GIAO</span>
        </div>
        <div v-if="state.orderDetail.MaTT === '4'" class="text-green-600 font-bold text-4xl p-6 bg-[#fffcf5] box">
            <span class="px-3 py-2 rounded-full border-2 border-green-600 mr-2 font-black"><i
                    class="fa-solid fa-check"></i></span>
            <span>ĐƠN HÀNG ĐÃ HOÀN THÀNH</span>
        </div>
        <div v-if="state.orderDetail.MaTT === '5'" class="text-red-600 font-bold text-4xl p-6 bg-[#fffcf5] box">
            <span class="px-4 py-1 rounded-full border-2 border-red-600 mr-2 font-black"><i
                    class="fa-solid fa-xmark"></i></span>
            <span>ĐÃ HUỶ ĐƠN HÀNG</span>
        </div>

        <div class="p-4 border bg-[#fafafa] box mt-[5px]">
            <div class="grid grid-flow-col grid-cols-3">
                <div class="w-full my-1 flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Mã đơn hàng
                    </span>
                    <span class="text-[#10284b] font-bold text-[1.6rem]">
                        {{ state.orderDetail?.MaDH }}
                    </span>
                </div>
                <div class="w-full my-1 flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Tên người nhận
                    </span>
                    <span class="text-[#10284b] font-bold text-[1.6rem]">
                        {{ state.orderDetail?.TenNguoiNhan }}
                    </span>
                </div>
                <div class="w-full my-1  flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Email
                    </span>
                    <span class="text-[#10284b] font-bold text-[1.6rem]">
                        {{ authStore.user?.email }}
                    </span>
                </div>
            </div>

            <div class="grid grid-flow-col grid-cols-3">
                <div class="w-full my-1  flex flex-col">
                    <span class="text-[#778393] font-medium">
                        SĐT người nhận
                    </span>
                    <span class="text-[#10284b] font-bold text-[1.6rem]">
                        {{ state.orderDetail?.SDTNguoiNhan }}
                    </span>
                </div>
                <div class="w-full my-1  flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Phương thức thanh toán
                    </span>
                    <span v-if="state.orderDetail.MaPT === 'PTOFF'" class="text-[#10284b] font-bold text-[1.6rem]">
                        Thanh Toán Khi Nhận Hàng
                    </span>
                    <span v-if="state.orderDetail.MaPT === 'PTOL'" class="text-[#10284b] font-bold text-[1.6rem]">
                        Thanh Toán Trực Tuyến với VNPAY
                    </span>
                    <span v-if="state.orderDetail.MaPT === 'PTOLMOMO'" class="text-[#10284b] font-bold text-[1.6rem]">
                        Thanh Toán Trực Tuyến với MOMO
                    </span>

                </div>
                <div class="w-full my-1  flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Trạng thái thanh toán
                    </span>
                    <span v-if="state.orderDetail.MaThanhToan === '01'" class="text-[#10284b] font-bold text-[1.6rem]">
                        Đã Thanh Toán
                    </span>
                    <span v-else class="text-[#10284b] font-bold text-[1.6rem]">
                        Chưa Thanh Toán
                    </span>

                </div>

            </div>
            <div class="grid grid-flow-col grid-cols-[1fr_2fr]">
                <div class="w-full my-1 flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Ngày đặt
                    </span>
                    <span class="text-[#10284b] font-bold text-[1.6rem]">
                        {{ moment(state.orderDetail?.NgayDat).format('DD/MM/YYYY HH:mm') }}
                    </span>
                </div>
                <div class="w-full my-1  flex flex-col">
                    <span class="text-[#778393] font-medium">
                        Địa chỉ nhận hàng
                    </span>
                    <span class="text-[#10284b] font-bold text-[1.6rem]">
                        {{ state.orderDetail?.DiaChiNguoiNhan }}
                    </span>
                </div>
            </div>

            <div class="py-1 flex flex-col min-h-[3rem]">
                <span class="text-[#778393] font-medium">
                    Ghi chú
                </span>
                <span class="text-[#10284b] font-bold text-[1.6rem]">
                    {{ state.orderDetail?.GhiChu }}
                </span>

            </div>
        </div>

        <div class="box  mt-[5px]">
            <table>
                <tr className="tr1">
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th className="quantity">Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                <tr v-for="(item, index) in state.orderDetail.chitietdonhang" :key="index" class="tr2">
                    <td>
                        <!-- <img :src="`/images/products/${item.sanpham.HinhAnh}`" /> -->
                        <img :src="renderFileURL('/images/products/', item.sanpham.HinhAnh)" />
                    </td>
                    <td>{{ item.sanpham.TenSP }}</td>
                    <td>{{ formatMoney(item.sanpham.GiaTien) }} đ</td>

                    <td class="quantity">
                        x{{ item.quantity }}
                    </td>
                    <td>{{ formatMoney(item.quantity * item.sanpham.GiaTien) }} đ</td>
                </tr>
                <tr class="tr3">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="td_tt">Tổng tiền hàng: </td>
                    <td class="td_price">{{ formatMoney(state.totalPriceTmp) }} đ</td>
                </tr>
                <tr v-if="state.orderDetail.MaKM" class="tr3">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class=" td_tt text-2xl font-medium text-sky-500"> Khuyến mãi {{ state.khuyenMai.PhanTram }} %</td>
                    <td class="td_pric text-3xl font-medium text-sky-500">- {{
                        formatMoney(((state.totalPriceTmp *
                            state.khuyenMai.PhanTram) / 100)) }} đ
                    </td>
                </tr>
                <tr class="tr3">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="td_tt">Thành tiền: </td>
                    <td class="td_price">{{ formatMoney(state.orderDetail?.TongTienDonHang) }} đ</td>
                </tr>
            </table>
            <div class="flex justify-end pr-10 mt-[5px] p-4 border-t">
                <div>
                    <router-link :to="{ name: 'UserProfile' }">
                        <button class="btn-custom ">Xem đơn hàng</button>
                    </router-link>
                </div>
                <div>
                    <router-link :to="{ name: 'CheckoutView' }"><button class="btn-custom ml-6">Mua lại</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, onMounted } from "vue";
import { orderDetail, khuyenMai } from '@/api/auth';
import { useAuthStore } from '@/stores';
import { useRoute } from 'vue-router'
import { useRouter } from 'vue-router'
import { renderFileURL } from '@/utils/helper.js'
import moment from 'moment'
const state = reactive({
    orderDetail: {},
    khuyenMai: {},
    totalPriceTmp: 0,
    totalPrice: 0,
    loading: true,
})
const authStore = useAuthStore();
const router = useRouter();
const route = useRoute()
const { MaDH } = route.params
const formatMoney = (money) => {
    return money
        ?.toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        ?.replace("₫", "");
};


const getOrderDetail = async () => {
    const { data: res } = await orderDetail(MaDH)
    console.log('order detail', res);
    if (!res?.data) {
        router.push({
            name: '404',
        });
    }
    state.loading = false;
    if (res) {
        state.orderDetail = res.data
    }
    let totalMoney = 0;
    state.orderDetail.chitietdonhang.forEach(item => {
        totalMoney += Number(item.quantity * item.sanpham.GiaTien);
    })
    state.totalPriceTmp = totalMoney;
}
const getKhuyenMai = async () => {
    const { data: res } = await khuyenMai()
    if (res?.data) {
        if (state.orderDetail.MaKM) {
            state.khuyenMai = res.data.find(item => item.MaKM == state.orderDetail.MaKM)
            console.log('makm', state.khuyenMai.PhanTram);
        }
    }
}

onMounted(async () => {
    await getOrderDetail();
    await getKhuyenMai();
})

</script>
<style lang="scss" scoped>
@import "@/style/cart.scss";

.btn-custom {
    padding: 1rem 1.2rem;
    border: 0;
    font-size: 1.4rem;
    font-weight: bold;
    border-radius: 0.5rem;
    border: 0.1rem solid rgb(14, 165, 233);
    background-color: white;
}

.btn-custom:hover {
    background-color: rgb(14, 165, 233);
    cursor: pointer;
    color: white;
}

.box {
    box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.12);
}
</style>