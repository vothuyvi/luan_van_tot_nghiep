<template>
    <div v-loading="state.loading" class="w-4/5 mr-auto ml-auto mt-8">
        <div class="grid grid-cols-[300px_minmax(900px,_1fr)_100px]">
            <div>
                <div class="border m-8" style="box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.13)">
                    <div class="text-3xl text-sky-500 border-b font-medium p-4">
                        DANH MỤC SẢN PHẨM
                    </div>
                    <div class="m-4 text-2xl font-normal">
                        <div v-for="(item, index) in state.allProductTypeData" :key="index"
                            class="p-2 hover:text-sky-600 cursor-pointer"
                            @click="onClickCategory(item.MaLoai, item.TenLoai)">
                            {{ item.TenLoai }}
                        </div>

                    </div>
                </div>
                <div class="border m-8" style="box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.13)">
                    <div class="text-3xl text-sky-500 border-b font-medium p-4">
                        LỌC THEO GIÁ
                    </div>
                    <!-- <div class="slidecontainer p-8 my-16">
                        <el-slider
                            v-model="filterValue"
                            :marks="marks"
                            :min="filter.minPrice"
                            :max="filter.maxPrice"
                        />
                        <vue-slider
                            v-model="filterValue2"
                            :tooltip="'always'"
                            :min="0"
                            :max="10000000"
                            :min-range="1000000"
                            :tooltip-placement="['top', 'bottom']"
                            :interval="500000"
                            :tooltip-formatter="filter.formatter"
                        ></vue-slider>
                    </div> -->
                    <div class="slidecontainer p-8 py-14 pt-[4.5rem]">
                        <div>
                            <Slider v-model="state.filterValue2" :merge="10000000" :min="0" :max="50000000" :step="500000"
                                :format="state.filter.formatter" />
                        </div>
                        <div class="mt-14 text-2xl font-bold text-white">
                            <button
                                class="p-4 rounded-lg w-full hover:bg-sky-500 hover:text-white border-2 border-sky-500 text-black"
                                @click="handelOnSearch">
                                Áp dụng
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border m-8" style="box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.13)">
                    <div class="text-3xl text-sky-500 border-b font-medium p-4">
                        SẢN PHẨM BÁN CHẠY
                    </div>
                    <div class="mb-10 p-3">
                        <Splide :options="options" aria-label="My Favorite Images">
                            <SplideSlide v-for="(item, index) in state.bestData" :key="index">
                                <!-- <img :src="`/images/products/${item.HinhAnh}`" class="object-cover w-full h-96" /> -->
                                <img :src="renderFileURL('/images/products/', item.HinhAnh)"
                                    class="object-cover w-full h-96" />
                                <div class="name_sp">
                                    <span>{{ item.TenSP }} </span>
                                </div>
                                <div class="spice_sp">
                                    <span>{{ formatMoney(item.GiaTien) }} đ</span>
                                </div>
                                <div class="btn_buy">
                                    <button v-if="item.SoLuong === 0" disabled class="cursor-not-allowed opacity-50">Thêm
                                        vào giỏ
                                        hàng</button>
                                    <button v-else @click="addOrder(item.MaSP)">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                            </SplideSlide>
                        </Splide>
                    </div>
                </div>
            </div>

            <div class="m-8">
                <div v-if="!query.MaLoai" class="text-3xl text-sky-500 font-medium text-center p-4 border-b">
                    SẢN PHẨM
                </div>
                <div v-else class="text-3xl text-sky-500 font-medium text-center p-4 border-b">{{ query.TenLoai }}</div>
                <div class="container_sp_new">
                    <div v-for="(item, index) in state.allProductData " :key="index"
                        class="giavi_list list-image-none relative">
                        <router-link :to="{ name: 'ProductDetailView', params: { MaSP: item.MaSP } }">
                            <!-- <img :src="`/images/products/${item.HinhAnh}`" class="object-cover w-full h-96" /> -->
                            <img :src="renderFileURL('/images/products/', item.HinhAnh)" class="object-cover w-full h-96" />
                        </router-link>

                        <router-link :to="{ name: 'ProductDetailView', params: { MaSP: item.MaSP } }">
                            <div class="name_sp">
                                <span>{{ item.TenSP }}</span>
                            </div>
                        </router-link>
                        <div v-if="item.SoLuong === 0" class="absolute top-[1rem] right-[0] z-[10] ">
                            <div class="text-red-600 text-xl font-bold text-right w-[8rem] bg-yellow-500 p-4"> Hết hàng
                            </div>
                        </div>
                        <div class="spice_sp">
                            <span>{{ formatMoney(item.GiaTien) }} đ</span>
                        </div>
                        <div class="btn_buy">
                            <button v-if="item.SoLuong === 0" disabled class="cursor-not-allowed opacity-50">Thêm vào giỏ
                                hàng</button>
                            <button v-else @click="addOrder(item.MaSP)">
                                <i class="fa-solid fa-cart-plus"></i> Thêm vào
                                giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
                <div class="my-8 flex justify-center">
                    <el-pagination background layout="prev, pager, next" :total="state.totalRecord" :page-size="9"
                        @current-change="handleCurrentChange" />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup >
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import { productBest, productTypeAll, productList } from '@/api/auth';
import { reactive, onMounted, watch } from "vue";
import { useRouter } from 'vue-router'
import { useRoute } from 'vue-router'
import { useAuthStore } from '@/stores';
import "vue-slider-component/theme/antd.css";
import Slider from "@vueform/slider";
import { addOrder, renderFileURL } from '@/utils/helper.js'

const options = {
    rewind: true,
    perPage: 1,
    gap: "1rem",
    autoplay: true,
    breakpoints: {
        1000: {
            perPage: 1,
        },
    },
};

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const { MaLoai, TenLoai, MinPrice, MaxPrice, page, TenSP } = route.query;

watch(
    () => route.query,
    async (newValue, oldValue) => {
        console.log('co thay doi:', newValue)
        query.MaLoai = newValue.MaLoai;
        query.TenLoai = newValue.TenLoai;
        query.MinPrice = newValue.MinPrice;
        query.MaxPrice = newValue.MaxPrice;
        query.TenSP = newValue.TenSP;
        state.filterValue2 = [newValue.MinPrice, newValue.MaxPrice]
        await getProductList();
    },
    // { deep: true }
)

const state = reactive({
    filter: {
        minRange: 0,
        formatter: (v) =>
            `${("" + v).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}đ`,
    },

    filterValue2: [0, 50000000],
    bestData: [],
    allProductData: [],
    allProductTypeData: [],
    totalRecord: 0,
    loading: true,
});
const query = reactive({
    MaLoai: MaLoai || '',
    TenLoai: TenLoai || '',
    MinPrice: MinPrice || 0,
    MaxPrice: MaxPrice || 50000000,
    TenSP: TenSP || '',
    page: page || 1,

})

const marks = reactive({
    0: "0",
    10000: "10000",
});

const formatMoney = (money) => {
    return money
        .toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        .replace("₫", "");
};

const getBest = async () => {
    const { data: res } = await productBest();
    console.log(res.data);

    const bestList = [];
    res.data.forEach(item => {
        const itemData = {
            MaSP: item.MaSP,
            TenSP: item.TenSP,
            HinhAnh: item.HinhAnh,
            GiaTien: item.GiaTien,
            SoLuong: item.SoLuong,
        };
        bestList.push(itemData);
    });
    state.bestData = bestList;
};

const getAllProductType = async () => {
    const { data: data } = await productTypeAll();
    console.log(data);
    const allListType = [];
    data.forEach((item) => {
        const itemData = {
            MaLoai: item.MaLoai,
            TenLoai: item.TenLoai,
        };
        allListType.push(itemData);
    });
    state.allProductTypeData = allListType;
}


const getProductList = async () => {
    const { data: res } = await productList(query);
    console.log(res);
    if (res?.data) {
        state.allProductData = res?.data.data;
        state.totalRecord = res?.data.total;
    }
    state.loading = false;
}

const onClickCategory = (MaLoai, TenLoai) => {
    console.log(MaLoai);
    query.MaLoai = MaLoai;
    console.log(TenLoai);
    query.TenLoai = TenLoai;
    router.push({ name: 'ProductView', query: query })
    getProductList()
}

const handelOnSearch = () => {
    query.MinPrice = state.filterValue2[0];
    query.MaxPrice = state.filterValue2[1];
    router.push({ name: 'ProductView', query: query })
    getProductList();
}

onMounted(async () => {
    await getBest();
    await getAllProductType();
    await getProductList();
});

const handleCurrentChange = (val) => {
    console.log(`current page: ${val}`)
    query.page = val
    getProductList()
}
</script>
<style lang="scss" scoped>
@import "@/style/product.scss";

:deep() {
    .vue-slider-dot-tooltip-inner {
        background-color: rgb(14, 165, 233);
    }

    .vue-slider-dot-tooltip-inner-top::after {
        border-top-color: rgb(14, 165, 233);
    }

    .vue-slider-dot-tooltip-inner-bottom::after {
        border-bottom-color: rgb(14, 165, 233);
    }

    .slider-tooltip {
        background-color: rgb(14, 165, 233);
        border-color: rgb(14, 165, 233);
        padding: 5px;
        font-size: 12px;
    }

    .slider-connect {
        background-color: rgb(14, 165, 233);
    }

    .slider-handle:focus {
        box-shadow: var(--slider-handle-shadow,
                0.5px 0.5px 2px 1px rgba(0, 0, 0, 0.32));
    }
}
</style>
<style src="@vueform/slider/themes/default.css"></style>
