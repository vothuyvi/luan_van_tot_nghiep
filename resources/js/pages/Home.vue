<template>
    <Slider />
    <div class="container_giavi">
        <div class="giavi_title">
            <h3>KHUYẾN MÃI</h3>
            <p class="">
                <i class="fa-regular fa-window-minimize"></i>
                <i class="fa-regular fa-window-minimize"></i>
                <i class="fa-regular fa-window-minimize"></i>
            </p>
        </div>
        <div v-for="(item, index) in state.khuyenMai" :key="index" class="grid gap-10 w-4/5 m-auto mt-5">
            <div class=" flex justify-between items-center bg-sky-500 h-40 p-8">
                <div class="flex font-Lobster text-[3rem] text-white font-bold p-4 bg-red-500 w-[31rem]">
                    <marquee>{{ item.TenKM }}</marquee>
                </div>
                <div class="grid grid-cols-1">
                    <span class="text-red-400 text-[3rem]">Giảm ngay {{ item.PhanTram }}%</span>
                    <span class="text-white text-2xl">Đơn tối thiểu {{ formatMoney(item.DieuKienApDung) }} đ</span>
                </div>
                <span class="text-2xl font-medium text-white">Thời gian áp dụng: từ ngày {{
                    moment(item.NgayBatDau).format('DD/MM/YYYY') }} -
                    {{ moment(item.NgayKetThuc).format('DD/MM/YYYY') }}
                </span>
            </div>
        </div>
        <div class="giavi_title">
            <h3>SẢN PHẨM MỚI</h3>
            <p class="">
                <i class="fa-regular fa-window-minimize"></i>
                <i class="fa-regular fa-window-minimize"></i>
                <i class="fa-regular fa-window-minimize"></i>
            </p>
        </div>
        <div class="container_giavi_new">

            <div v-for="(item, index) in state.newData" :key="index" class="giavi_list list-image-none relative">
                <router-link :to="{ name: 'ProductDetailView', params: { MaSP: item.MaSP } }">
                    <!-- <img :src="`/images/products/${item.HinhAnh}`" /> -->
                    <img :src="renderFileURL('/images/products/', item.HinhAnh)" />
                </router-link>
                <router-link :to="{ name: 'ProductDetailView', params: { MaSP: item.MaSP } }">
                    <div class="name_sp">
                        <span>{{ item.TenSP }}</span>
                    </div>
                </router-link>
                <div v-if="item.SoLuong === 0" class="absolute top-[1rem] right-[0] z-[10] ">
                    <div class="text-red-600 text-xl font-bold text-right w-[8rem] bg-yellow-500 p-4"> Hết hàng</div>
                </div>
                <div class="spice_sp">
                    <span>{{ formatMoney(item.GiaTien) }} đ</span>
                </div>
                <div class="btn_buy">
                    <button v-if="item.SoLuong === 0" disabled class="cursor-not-allowed opacity-50">Thêm vào giỏ
                        hàng</button>
                    <button v-else @click="addOrder(item.MaSP)">
                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>


        </div>
        <div class="giavi_title">
            <h3>SẢN PHẨM BÁN CHẠY</h3>
            <p class="">
                <i class="fa-regular fa-window-minimize"></i>
                <i class="fa-regular fa-window-minimize"></i>
                <i class="fa-regular fa-window-minimize"></i>
            </p>
        </div>
        <div class="container_giavi_best w-4/5 m-auto mt-7 mb-32">
            <span>
                <ProductBest />
            </span>
        </div>
    </div>
</template>
<script setup>
import Slider from "@/components/Slider.vue";
import ProductBest from "@/components/ProductBest.vue";
import { productNew, khuyenMai } from '@/api/auth';
import { reactive, onMounted } from "vue";
import moment from 'moment'
import { addOrder, renderFileURL } from '@/utils/helper.js'

const state = reactive({
    newData: [],
    khuyenMai: [],
});
const formatMoney = (money) => {
    return money
        .toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        .replace("₫", "");
};
const getNew = async () => {
    const { data: res } = await productNew();
    console.log(res);
    const newList = [];
    res.forEach(item => {
        const itemData = {
            MaSP: item.MaSP,
            TenSP: item.TenSP,
            HinhAnh: item.HinhAnh,
            GiaTien: item.GiaTien,
            SoLuong: item.SoLuong,
        };
        newList.push(itemData);
    });
    state.newData = newList;
};

const getKhuyenMai = async () => {
    const { data: res } = await khuyenMai()
    // console.log('khuyen mai: ', res);
    if (res?.data) {
        state.khuyenMai = res.data;
        console.log('khuyến mãi: ', state.khuyenMai);
    }
}


onMounted(async () => {
    console.log('up code nè,hiiiiiiii')
    await getNew();
    await getKhuyenMai();

});

</script>
<style lang="scss" scoped>
@import "@/style/home.scss";
</style>
