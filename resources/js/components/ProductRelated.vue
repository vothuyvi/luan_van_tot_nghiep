<template>
    <Splide :options="options">
        <SplideSlide v-for="(item, index) in state.data" :key="index">
            <router-link :to="{ name: 'ProductDetailView', params: { MaSP: item.MaSP } }">
                <!-- <img :src="`/images/products/${item.HinhAnh}`" class="object-cover w-full h-96" /> -->
                <img :src="renderFileURL('/images/products/', item.HinhAnh)" class="object-cover w-full h-96" />
            </router-link>
            <div class="name_sp">
                <span>{{ item.TenSP }}</span>
            </div>
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
        </SplideSlide>
    </Splide>
</template>

<script setup>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import { productRelated } from '@/api/auth';
import { reactive, onMounted } from "vue";
import { useRoute } from 'vue-router'
import { addOrder, renderFileURL } from '@/utils/helper.js'

const options = {
    rewind: true,
    perPage: 4,
    gap: "1rem",
    autoplay: true,
    breakpoints: {
        1000: {
            perPage: 1,
        },
    },
};
const route = useRoute();
const MaSP = route.params.MaSP;
const state = reactive({
    data: [],
});
const formatMoney = (money) => {
    return money
        .toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        .replace("₫", "");
};
const getProductRelated = async () => {
    const form = {
        MaSP: MaSP,
        MaLoai: '',
    }
    // console.log('masp', form.MaSP)
    const { data: res } = await productRelated(form);
    console.log('list data', res.sanpham);
    const List = [];
    res.sanpham.forEach(item => {
        const itemData = {
            MaSP: item.MaSP,
            TenSP: item.TenSP,
            HinhAnh: item.HinhAnh,
            GiaTien: item.GiaTien,
            SoLuong: item.SoLuong,
        };
        List.push(itemData);
    });
    state.data = List;

};
onMounted(async () => {
    await getProductRelated();

});

</script>
<style lang="scss" scoped>
.name_sp {
    width: 100%;
    height: 5rem;
    font-size: 1.6rem;
    font-weight: bold;
    align-items: center;
    text-align: center;
    margin-top: 1.5rem;
}

.spice_sp {
    font-size: 1.4rem;
    font-weight: bold;
    text-align: center;
    margin-top: 1.5rem;
    color: rgb(14, 165, 233);
}

.btn_buy {
    display: flex;
    justify-content: center;
}

.btn_buy button {
    margin-top: 1.5rem;
    margin-bottom: 2rem;
    padding: 1rem;
    border-radius: 1rem;
    border: 0;
    font-weight: bold;
    font-size: 1.6rem;
    cursor: pointer;
    background-color: #fff;
    border: 2px solid rgb(14, 165, 233);
}

.btn_buy button:hover {
    background-color: rgb(14, 165, 233);
    color: #ffff;
}
</style>
