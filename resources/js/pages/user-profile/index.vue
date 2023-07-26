<template>
    <div>
        <div class="container__login">
            <div class="max-w-[120rem] w-full">
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <div
                            class="w-[25rem] h-[9rem] border border-solid border-[#e4e7ed] rounded-lg flex items-center p-6 shadow-card">
                            <!-- <el-avatar :src="`/images/uploads/${authStore.user?.hinhanh}`" :size="60" :icon="UserFilled"
                                class="text-5xl" /> -->
                            <el-avatar :src="renderFileURL('/images/uploads/', authStore.user?.hinhanh)" :size="60"
                                :icon="UserFilled" class="text-5xl" />
                            <div class="ml-4 font-medium text-3xl"> {{ authStore.user?.name }}</div>
                        </div>
                        <div
                            class="w-[25rem] rounded-lg flex p-10 mt-2 flex-col text-2xl border border-solid border-[#e4e7ed] shadow-card">
                            <div :class="`${state.type === 'Profile'
                                ? 'text-red-500'
                                : ''
                                }`" class="my-2 cursor-pointer hover:text-[#f44336] w-fit" @click="setType('Profile')">
                                <i class="fa-solid fa-user"></i>
                                Thông tin cá nhân
                            </div>
                            <div :class="`${state.type === 'Purchase'
                                ? 'text-red-500'
                                : ''
                                }`" class="my-2 cursor-pointer hover:text-[#f44336] w-fit"
                                @click="setType('Purchase')">
                                <i class="fa-solid fa-file-lines"></i>
                                Lịch sử mua hàng
                            </div>
                            <!-- <div class="my-2 cursor-pointer hover:text-[#f44336] w-fit">
                                <i class="fa-solid fa-ticket"></i>
                                Kho Voucher
                            </div> -->
                            <div class="my-2 cursor-pointer hover:text-[#f44336] w-fit" @click="handleLogout()">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Đăng Xuất
                            </div>
                        </div>
                    </div>
                    <div v-if="state.type === 'Profile'" class="text-[1.6rem] w-full ml-8">
                        <el-card class="box-card">
                            <template #header>
                                <div class="card-header flex justify-between w-full">
                                    <span>Hồ Sơ Của Tôi</span>
                                    <el-button v-if="!state.isEdit" type="primary" plain @click="handleShowEdit()">
                                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                                        Chỉnh Sửa</el-button>
                                    <div v-else>
                                        <el-button plain @click="handleCancelEdit">Quay lại</el-button>
                                        <el-button type="success" plain @click="handleUpdateProfile">Lưu</el-button>
                                    </div>
                                </div>
                            </template>
                            <div class="flex justify-between">
                                <div class="border-r border-solid border-[#e4e7ed] w-[60%] pt-8 px-16 pb-[10rem]">
                                    <div v-if="state.error" class="text-red-600 text-xl font-medium">
                                        <div v-for="(key, value) in state.error" :key="key">
                                            <div v-for="(item, index) in state.error[value]" :key="index">
                                                {{ item }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4 my-6">
                                        <div class="min-w-[9rem] text-[#939FA4]">
                                            Họ Tên
                                        </div>
                                        <div v-if="!state.isEdit" class="font-medium">
                                            {{ authStore.user?.name }}
                                        </div>
                                        <el-input v-else v-model="form.name" placeholder="" />
                                    </div>
                                    <div class="flex items-center gap-4 my-6">
                                        <div class="min-w-[9rem] text-[#939FA4]">
                                            Email
                                        </div>
                                        <div v-if="!state.isEdit" class="font-medium">
                                            {{ authStore.user?.email }}
                                        </div>
                                        <el-input v-else v-model="form.email" placeholder="" disabled />
                                    </div>
                                    <div class="flex items-center gap-4 my-6">
                                        <div class="min-w-[9rem] text-[#939FA4]">
                                            Sinh Nhật
                                        </div>
                                        <div v-if="!state.isEdit" class="font-medium">
                                            {{ authStore.user?.birthday }}
                                        </div>
                                        <!-- <el-input v-else v-model="form.birthday" placeholder="" /> -->
                                        <el-date-picker v-else v-model="form.birthday" type="date" placeholder=""
                                            format="DD/MM/YYYY" value-format="DD/MM/YYYY" :disabled-date="disabledDate"
                                            :clearable="false" />
                                    </div>
                                    <div class="flex items-center gap-4 my-6">
                                        <div class="min-w-[9rem] text-[#939FA4]">
                                            SĐT
                                        </div>
                                        <div v-if="!state.isEdit" class="font-medium">
                                            {{ authStore.user?.phone }}
                                        </div>
                                        <el-input v-else v-model="form.phone" placeholder="" />
                                    </div>

                                    <div class="flex items-center gap-4 my-6">
                                        <div class="min-w-[9rem] text-[#939FA4]">
                                            Địa Chỉ
                                        </div>
                                        <div v-if="!state.isEdit" class="font-medium">
                                            {{ authStore.user?.address }}
                                        </div>
                                        <el-input v-else v-model="form.address" placeholder="" />
                                    </div>
                                </div>
                                <div class="w-[40%] px-16 py-8">
                                    <div class="font-medium text-center text-[#939FA4]">
                                        Ảnh Đại Diện
                                    </div>
                                    <div
                                        class="avatar-uploader text-center mt-4 rounded-lg overflow-hidden w-[16rem] h-[16rem] mx-auto">
                                        <!-- <img :src="form.fileUpload ? state.imageUrl : `/images/uploads/${authStore.user?.hinhanh}`"
                                            class="avatar object-cover" /> -->
                                        <img :src="form.fileUpload ? state.imageUrl : renderFileURL('/images/uploads/', authStore.user?.hinhanh)"
                                            class="avatar object-cover" />
                                    </div>
                                    <div v-if="state.isEdit" class="mt-4 text-center">
                                        <el-button @click="handleChooseFile()"><i class="fa-regular fa-image mr-2"></i> Chọn
                                            Ảnh</el-button>
                                    </div>
                                </div>
                            </div>
                        </el-card>
                        <input ref="inputUpload" type="file" accept="image/png, image/jpeg, image/jpg, image/webp"
                            class="hidden" @change="handleChangeFile" />
                    </div>
                    <div v-if="state.type === 'Purchase'" class="text-[1.6rem] w-full ml-8">
                        <el-card>
                            <template #header>
                                <div class="card-header flex justify-between w-full text-3xl font-medium cursor-pointer ">
                                    <span v-for="(item, index) in state.status" :key="index"
                                        :class="item.MaTT == state.MaTT ? 'border-b-2 border-red-500 text-red-500 pb-4' : ''"
                                        @click="onClickStatus(item.MaTT, item.TrangThaiDon)">{{ item.TrangThaiDon }}</span>
                                </div>
                            </template>
                            <div class="px-8 py-10 w-full">

                                <div v-for="(item, index) in state.allOrderData" :key="index"
                                    class="border border-solid border-[#e4e7ed] rounded-lg p-5 mb-8 ">
                                    <div class="border-b border-solid border-[#e4e7ed] pb-4 flex justify-between">
                                        <div class="text-[#808089] font-bold text-sky-500">
                                            {{ renderMaTT(item.MaTT) }}
                                        </div>
                                        <div v-if="item.MaTT == 4" class="text-green-500">Đơn hàng đã được giao thành công
                                        </div>
                                        <div v-if="item.MaTT == 5" class="text-red-500">Đơn hàng đã bị huỷ
                                        </div>
                                    </div>
                                    <router-link :to="{ name: 'OrderDetailView', params: { MaDH: item.MaDH } }">
                                        <div>
                                            <div class="text-xl font-medium pt-2 flex justify-between">
                                                <div class="text-sky-500 ">
                                                    {{ moment(item.NgayDat).format('DD/MM/YYYY HH:mm') }}
                                                </div>
                                                <div>
                                                    <div v-if="item.MaThanhToan === '01' || item.MaTT === '4'"
                                                        class="text-sky-500 font-bold"> Đã
                                                        thanh toán</div>
                                                    <div v-else class="text-sky-500 font-bold"> Chưa thanh toán </div>
                                                </div>

                                            </div>

                                            <div v-for="(item, index) in item.chitietdonhang" :key="index"
                                                class="flex justify-between py-5 border-b border-solid border-[#e4e7ed]">
                                                <div class="h-[8rem] w-[8rem] rounded-md overflow-hidden">
                                                    <!-- <img :src="`/images/products/${item.sanpham.HinhAnh}`" alt="Sample 1"
                                                        class="object-cover w-full h-[8rem]" /> -->
                                                    <img :src="renderFileURL('/images/products/', item.sanpham.HinhAnh)"
                                                        class="object-cover w-full h-[8rem]" />
                                                </div>
                                                <div class="flex-1 ml-4">
                                                    <div class="text-[1.4rem] font-medium">
                                                        {{ item.sanpham.TenSP }}
                                                    </div>
                                                    <div class="text-[1.2rem] text-gray-600"> Đơn giá: {{
                                                        formatMoney(item.sanpham.GiaTien) }}
                                                        đ
                                                    </div>
                                                    <div class="text-[1.2rem] text-gray-600"> Số lượng: {{ item.quantity }}
                                                    </div>

                                                </div>
                                                <div class="text-[1.6rem] whitespace-nowrap w-fit">

                                                    <span class="font-medium text-[1.2rem]"> Thành tiền: </span>
                                                    <span class="text-red-600 font-medium"> {{ formatMoney(item.total) }}
                                                        đ</span>

                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center">
                                                <div class="flex-1">
                                                    <div v-if="item.MaPT == 'PTOFF'" class="font-medium">Phương
                                                        thức
                                                        thanh toán: <span class="font-normal text-sky-500">Thanh toán khi
                                                            nhận
                                                            hàng</span>
                                                    </div>
                                                    <div v-if="item.MaPT == 'PTOL'" class="font-medium">Phương thức
                                                        thanh toán: <span class="font-normal text-sky-500">Thanh toán trực
                                                            tuyến
                                                            với
                                                            VNPAY</span>
                                                    </div>
                                                    <div v-if="item.MaPT == 'PTOLMOMO'" class="font-medium">Phương thức
                                                        thanh toán: <span class="font-normal text-sky-500">Thanh toán trực
                                                            tuyến
                                                            với
                                                            MOMO</span>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <span class="font-bold">Tổng tiền: </span>
                                                    <span class="font-bold text-red-600 text-[2rem]">
                                                        {{ formatMoney(item.TongTienDonHang) }} ₫
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </router-link>
                                </div>
                                <div v-if="state.allOrderData.length === 0"
                                    class="flex flex-col justify-center items-center p-8">
                                    <div class="w-[10rem] "><img src="/images/products/order1.png" alt=""></div>
                                    <div> Chưa có đơn hàng</div>
                                </div>
                            </div>

                        </el-card>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive, onMounted } from "vue";
import { getInformation } from '@/api/auth';
import { useRouter } from 'vue-router';
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/stores';
import { UserFilled } from '@element-plus/icons-vue';
import { logout, statusAll, orders } from '@/api/auth';
import { updateProfile } from '@/api/auth';
import { removeToken } from '@/utils/auth';
import { renderFileURL } from '@/utils/helper.js'
import moment from 'moment'
import { ElMessage } from 'element-plus'


const router = useRouter();
const route = useRoute();
// const MaTT = route.query;
// const query = reactive({
//     MaTT: MaTT || '',
// })
const state = reactive({
    type: "Profile", // Profile, Purchase
    isEdit: false,
    status: "all",
    MaTT: '',
    TrangThaiDon: '',
    allOrderData: [],
    chitietdonhang: [],
    totalPrice: 0,
    error: '',
});
const form = reactive({
    name: '',
    address: '',
    phone: '',
    birthday: '',
    email: '',
    fileUpload: '',
});

const setStatus = (type) => {
    state.status = type;
};

const formatMoney = (money) => {
    return money
        .toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
        })
        .replace("₫", "");
};

const authStore = useAuthStore();

const getInfo = async () => {
    const { data: res } = await getInformation();
    // console.log('data: ', res);
    if (res?.data) {
        authStore.isLogin = true;
        authStore.user = res.data;
    }
};

const handleLogout = async () => {
    const { data: res } = await logout();
    if (res?.status) {
        console.log('logout success')
        removeToken();
        authStore.isLogin = false;
        authStore.user = {};
        router.push({
            name: 'LoginView',
        });
    }
};
const disabledDate = (time) => {
    return time.getTime() > Date.now()
}
const handleUpdateProfile = async () => {
    try {
        const formData = new FormData()
        formData.append('name', form.name)
        formData.append('address', form.address)
        formData.append('phone', form.phone)
        formData.append('birthday', form.birthday)
        formData.append('hinhanh', form.fileUpload)
        const { data: res } = await updateProfile(formData);
        if (res) {
            authStore.user = res?.data
            ElMessage({
                message: 'Cập nhật thành công!',
                type: 'success',
                grouping: true,
            });
        }
        state.error = null;
        state.isEdit = false;
    } catch (error) {
        console.log(error);
        console.log(error.response.data);
        state.error = error.response.data.errors;
    }
}

const inputUpload = ref(null);
const handleChangeFile = (e) => {
    const file = e.target.files[0];
    console.log(file);
    state.imageUrl = URL.createObjectURL(file);
    form.fileUpload = file
};
const handleChooseFile = () => {
    inputUpload.value.click();
};
const handleShowEdit = () => {
    const { name, address, phone, birthday, email } = authStore.user
    form.name = name;
    form.address = address;
    form.phone = phone;
    form.birthday = birthday;
    form.email = email;
    form.fileUpload = ''

    state.isEdit = true;
};
const handleCancelEdit = () => {
    form.fileUpload = ''
    inputUpload.value.value = ''
    state.isEdit = false;
};
const handleSave = () => {
    state.isEdit = false;
};
const setType = (type) => {
    state.type = type;
};

const getStatusAll = async () => {
    const { data: res } = await statusAll();
    console.log(res);
    state.status = res;
    state.status.unshift({
        "MaTT": "0",
        "TrangThaiDon": "Tất cả"
    });
    // console.log('trang thai', state.status);
    state.MaTT = state.status[0]?.MaTT // set default MaTT
}

const getOrderList = async () => {
    // console.log('query: ', query)
    const { data: res } = await orders(state.MaTT);
    // console.log(res.data);
    state.allOrderData = res?.data;
    const orderDetailList = [];
    let totalMoney = 0;
    res?.data.forEach((item) => {
        console.log('don hang', item);
        const itemData = {
            chitietdonhang: item.chitietdonhang,
            MaTT: item.MaTT,
        };
        orderDetailList.push(itemData);
    });
    console.log('allOrderData: ', state.allOrderData)
}

const renderMaTT = (MaTT) => {
    return state.status.find(item => item.MaTT == MaTT).TrangThaiDon
}

const onClickStatus = (MaTT, TrangThaiDon) => {
    console.log(MaTT);
    console.log(TrangThaiDon);
    state.MaTT = MaTT
    state.TrangThaiDon = TrangThaiDon;
    router.push({ name: 'UserProfile', query: { MaTT: state.MaTT, TrangThaiDon: state.TrangThaiDon } })
    getOrderList();
}

onMounted(async () => {
    await getInfo();
    await getStatusAll();
    await getOrderList();
});
</script>
<style lang="scss" scoped>
@import "@/style/login.scss";

:deep() {
    .el-card__header {
        display: flex;
        align-items: center;
        height: 9rem;
        padding: 4rem;
        font-size: 2rem;
        font-weight: bold;
    }

    .el-card__body {
        padding: 0;
    }

    .shadow-card {
        box-shadow: var(--el-box-shadow-light);
    }

    .avatar-uploader .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }

    .avatar-uploader .el-upload {
        border: 1px dashed var(--el-border-color);
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: var(--el-transition-duration-fast);
    }

    .avatar-uploader .el-upload:hover {
        border-color: var(--el-color-primary);
    }

    .el-icon.avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        text-align: center;
    }
}
</style>
