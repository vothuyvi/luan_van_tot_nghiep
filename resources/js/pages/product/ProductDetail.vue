<template>
    <div v-loading="state.loading" class="w-4/5 mx-auto my-10">
        <div class="grid grid-cols-2 mb-16">
            <div class="mx-auto">
                <div class="w-[45rem]">
                    <div class="w-[45rem] h-[45rem] ">
                        <Splide :options="mainOptions" ref="main" class="border border-solid border-[#e5e5e5]">
                            <SplideSlide v-for="(item, index) in state.images" :key="index" class="h-[45rem]">
                                <!-- <img :src="`/images/products/${item?.HinhAnh}`" class="object-contain w-full h-full" /> -->
                                <img :src="renderFileURL('/images/products/', item?.HinhAnh)"
                                    class="object-contain w-full h-full" />
                            </SplideSlide>
                        </Splide>
                    </div>

                    <Splide :options="thumbsOptions" ref="thumbs">
                        <SplideSlide v-for="(item, index) in state.images " :key="index">
                            <!-- <img :src="`/images/products/${item?.HinhAnh}`" class="object-cover w-full h-96" /> -->
                            <img :src="renderFileURL('/images/products/', item?.HinhAnh)"
                                class="object-cover w-full h-96" />
                        </SplideSlide>
                    </Splide>
                </div>
            </div>
            <div class="my-auto">
                <div class="text-3xl font-bold p-4 mb-4">
                    {{ state.form.TenSP }}
                </div>
                <div class="p-4 mb-4 text-2xl font-medium">
                    Kích thước: {{ state.form?.KichThuoc }}
                </div>
                <div v-if="state.form.SoLuong === 0" class="p-4 mb-4 text-2xl font-medium ">
                    Tình trạng: <span class="text-red-600 text-3xl font-bold"> Hết hàng</span>
                </div>
                <div v-else class="p-4 mb-4 text-2xl font-medium ">
                    Tình trạng: <span class="text-sky-500 text-3xl font-bold"> Còn hàng</span>
                </div>

                <div class="text-2xl font-medium text-sky-600 p-4 mb-4">
                    {{ formatMoney(state.form.GiaTien) }}đ
                </div>
                <div class="p-4 mb-4" :class="state.form.SoLuong == 0 ? 'hidden' : ''">
                    <button v-if="state.SoLuongOrder == 1"
                        class="border border-sky-600 w-10 rounded-lg text-2xl font-bold mr-5 hover:bg-sky-600 hover:text-white cursor-not-allowed"
                        @click="handelQuantity('MINUS')" disabled>
                        -
                    </button>
                    <button v-else
                        class="border border-sky-600 w-10 rounded-lg text-2xl font-bold mr-5 hover:bg-sky-600 hover:text-white"
                        @click="handelQuantity('MINUS')">
                        -
                    </button>
                    <span class="text-2xl mr-5">{{ state.SoLuongOrder }}</span>
                    <button v-if="state.SoLuongOrder < state.form.SoLuong"
                        class="border border-sky-600 w-10 rounded-lg text-2xl font-bold hover:bg-sky-600 hover:text-white"
                        @click="handelQuantity('PLUS')">
                        +
                    </button>
                    <button v-else
                        class="border border-sky-600 w-10 rounded-lg text-2xl font-bold hover:bg-sky-600 hover:text-white cursor-not-allowed"
                        @click="handelQuantity('PLUS')" disabled>
                        +
                    </button>

                </div>
                <div class="btn_buy mb-4">
                    <button v-if="state.form.SoLuong === 0" disabled class="cursor-not-allowed opacity-50">Thêm vào giỏ
                        hàng</button>
                    <button v-else @click="addOrder(state.form.MaSP)">
                        <i class="fa-solid fa-cart-plus"></i>
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
        <div class="flex my-10 gap-4 border-b">
            <div class="">
                <div :class="`${state.type === 'describe' ? 'border-b border-black' : ''
                    }`
                    " class="text-3xl font-bold p-2 mr-6 hover:text-sky-600 cursor-pointer"
                    @click="setType('describe')">
                    MÔ TẢ
                </div>
            </div>

            <div class="">
                <div :class="`${state.type === 'cmt' ? 'border-b border-black' : ''
                    }`
                    " class="text-3xl font-bold p-2 hover:text-sky-600 cursor-pointer" @click="setType('cmt')">
                    BÌNH LUẬN
                </div>
            </div>
        </div>
        <div v-if="state.type === 'describe'">
            <div v-html="state.form?.MoTa" class="text-2xl">

            </div>
        </div>
        <div v-if="state.type === 'cmt'">
            <div v-if="authStore.isLogin" class="flex w-full">
                <div class="w-[8%]">
                    <!-- <el-avatar :src="`/images/uploads/${authStore?.user?.hinhanh}`" :size="60" :icon="UserFilled"
                        class="text-5xl" /> -->
                    <el-avatar :src="renderFileURL('/images/uploads/', authStore?.user?.hinhanh)" :size="60"
                        :icon="UserFilled" class="text-5xl" />
                </div>
                <div class="w-[92%]">
                    <div class="border h-[8rem]">
                        <textarea v-model="state.commentForm.NoiDung" name="" id="" cols="30" rows="10"
                            placeholder="Viết bình luận..."
                            class="w-full max-h-full p-4 border-sky-500 text-2xl"></textarea>
                    </div>
                    <div class="text-right bg-slate-200 p-4">
                        <button class="px-6 py-2 text-3xl text-white bg-sky-700 rounded-md hover:bg-sky-800"
                            @click="onClickComment">
                            Đăng
                        </button>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="text-center text-3xl font-bold text-red-600">
                    <router-link :to="{ name: 'LoginView' }">
                        <el-alert title="Bạn cần đăng nhập để có thể viết bình luận!" type="error" center
                            :closable="false" />
                    </router-link>

                </div>

            </div>
            <div v-for="(item, index) in state.commentList" :key="index" class="flex w-full mt-10">
                <div class="w-[8%]">
                    <!-- <el-avatar :src="`/images/uploads/${item?.khachhang?.hinhanh}`" :size="60" :icon="UserFilled"
                        class="text-5xl" /> -->
                    <el-avatar :src="renderFileURL('/images/uploads/', item?.khachhang?.hinhanh)" :size="60"
                        :icon="UserFilled" class="text-5xl" />
                </div>
                <div class="w-[92%]">
                    <div class="text-2xl text-sky-600 font-bold pb-[0.5rem]">
                        {{ item?.khachhang?.email }}
                    </div>
                    <div class="text-2xl font-medium pb-[0.5rem]">
                        {{ item?.NoiDung }}
                    </div>
                    <div class="text-xl font-normal text-sky-600">
                        {{ moment(item?.NgayBinhLuan).format('DD/MM/YYYY HH:mm') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-[6rem] border-t">
            <div class="giavi_title">
                <h3>SẢN PHẨM LIÊN QUAN</h3>
                <p class="">
                    <i class="fa-regular fa-window-minimize"></i>
                    <i class="fa-regular fa-window-minimize"></i>
                    <i class="fa-regular fa-window-minimize"></i>
                </p>
            </div>
            <div class="mt-6">
                <ProductBest />
            </div>
        </div>
    </div>
    <Footer />
</template>
<script setup>
import { useRoute, useRouter } from 'vue-router'
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import { reactive, ref, onMounted, watch } from "vue";
import ProductBest from "@/components/ProductBest.vue";
import { productDetail, comments, commentStore } from "@/api/auth";
import { useAuthStore } from '@/stores'
import { UserFilled } from '@element-plus/icons-vue'
import moment from 'moment'
import { ElMessage } from 'element-plus'
import { renderFileURL } from '@/utils/helper.js'

const route = useRoute();
const router = useRouter();
const { MaSP } = route.params;

watch(
    () => route.params,
    async (newValue, oldValue) => {
        console.log('co thay doi:', newValue)
        if (newValue.MaSP) {
            await getProductDetail(newValue?.MaSP);
        }
    },
    { deep: true } // WATCH OBJECT
)


const authStore = useAuthStore();
const state = reactive({
    form: [],
    images: [],
    type: "describe", //describe, cmt
    commentList: [],
    commentForm: {
        MaSP: MaSP,
        NoiDung: '',

    },
    SoLuongOrder: 1,
    loading: true,
});

const setType = (type) => {
    state.type = type;
};

const formatMoney = (money) => {
    return money
        ?.toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        ?.replace("₫", "");
};

const getProductDetail = async (dataMaSP) => {
    const { data: res } = await productDetail(dataMaSP ? dataMaSP : MaSP);
    if (res) {
        state.form = res;
    } else {
        router.push({
            name: '404',
        });
    }
    state.loading = false;
    const listImage = [];
    res.anh.forEach((item) => {
        const itemData = {
            MaAnh: item.MaAnh,
            HinhAnh: item.HinhAnh,
        };
        listImage.push(itemData);
    });
    state.images = listImage;
}

const getAllComment = async () => {
    const { data: res } = await comments(MaSP);
    if (res) {
        state.commentList = res?.data;
    }
}

const checkValidate = () => {
    if (state.commentForm.NoiDung === '') {
        ElMessage({
            message: 'Hãy nhập nội dung bình luận.!',
            type: 'error',
            grouping: true,
        })
        return false

    }
    return true;
}

const onClickComment = async () => {
    if (checkValidate()) {
        const { data: res } = await commentStore(state.commentForm);
        state.commentForm.NoiDung = '';
        getAllComment();
    }
    // console.log(res);
    // console.log(res.anh);
}

const main = ref();
const thumbs = ref();

const mainOptions = {
    type: "loop",
    perPage: 1,
    perMove: 1,
    gap: "1rem",
    start: 1,
    arrows: false,
};

const thumbsOptions = {
    type: "slide",
    rewind: true,
    gap: "1rem",
    pagination: true,
    fixedWidth: 70,
    fixedHeight: 70,
    cover: true,
    focus: "center",
    isNavigation: true,
    updateOnMove: true,
};


const handelQuantity = (type) => {
    // console.log('type', type);
    if (type === 'PLUS') {
        state.SoLuongOrder += 1;

    } else if (state.SoLuongOrder != 1) {
        state.SoLuongOrder -= 1;
    }

}

const addOrder = (MaSP) => {
    const orders = JSON.parse(localStorage.getItem('orders'));
    if (orders) {
        const indexProduct = orders.findIndex(order => order.MaSP == state.form.MaSP);
        if (indexProduct != -1) {
            if (type === 'PLUS') {
                orders[indexProduct].SoLuong += state.SoLuongOrder;
            } else {
                orders[indexProduct].SoLuong -= state.SoLuongOrder;
            }

        } else {
            // nếu chưa có sản phẩm muốn thêm thì tạo mới 1 sản phẩm và thêm vào giỏ hàng
            orders.push({
                MaSP: state.form.MaSP,
                SoLuong: state.SoLuongOrder,
            });
        }
        // Cập nhật lại giỏ hàng trong localStorage
        localStorage.setItem('orders', JSON.stringify(orders));
    } else {
        // Nếu không có giỏ hàng trong localStorage thì tạo mới 1 giỏ hàng
        const orders = [
            {
                MaSP: state.form.MaSP,
                SoLuong: state.SoLuongOrder,
            },
        ];
        localStorage.setItem('orders', JSON.stringify(orders));
    }
    ElMessage({
        message: 'Thêm giỏ hàng thành công!',
        type: 'success',
        grouping: true,
    });
    authStore.onRefetchOrder();

}

onMounted(async () => {
    await getProductDetail();
    await getAllComment();
    const thumbsSplide = thumbs.value?.splide;
    if (thumbsSplide) {
        main.value?.sync(thumbsSplide);
    }
    main.value.go(1)
});

</script>
<style lang="scss" scoped>
.btn_buy {
    display: flex;
}

.btn_buy button {
    margin-top: 1rem;
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
    color: #fff;
}

.giavi_title {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 2rem;
}

.giavi_title h3 {
    color: rgb(14, 165, 233);
    font-size: 3rem;
    text-align: center;
    font-weight: bold;
}

.giavi_title p {
    font-size: 1.7rem;
    font-weight: 500;
    text-align: center;
    color: rgb(14, 165, 233);
}

:deep() {
    .splide__track--nav>.splide__list>.splide__slide.is-active {
        border: 1px solid #000;
    }
}
</style>
