<template>
  <div class="fixed z-[100] top-0 left-0 right-0 h-[13.4rem] bg-white">
    <header class="bg-white-300">
      <div class="mx-auto">
        <div class="flex items-center justify-between">
          <div class="ml-6 mt-2 mb-2">
            <img class="h-28 w-28" src="/images/products/logo2.png" alt="Logo Comany" />
          </div>
          <div v-if="!authStore.isLogin" class="flex mr-8">
            <router-link :to="{ name: 'LoginView' }">
              <div class="text-sky-500 text-2xl mr-7 font-bold hover:text-red-600">Đăng nhập</div>
            </router-link>
            <router-link :to="{ name: 'RegisterView' }">
              <div class="text-sky-500 text-2xl mr-7 font-bold hover:text-red-600">Đăng ký</div>
            </router-link>
            <span>
              <el-badge :value="authStore.orderCount" class="item">
                <router-link :to="{ name: 'CartView' }">
                  <span class="text-sky-500 text-2xl font-bold hover:text-red-600 cursor-pointer pb-12">
                    Giỏ hàng
                    <i class="fa-solid fa-cart-shopping"></i>
                  </span>
                </router-link>

              </el-badge>

              <div class="cart-model">
                <span>
                  <CartModel />
                </span>
              </div>
            </span>
          </div>
          <div v-else class="flex items-center mr-4">
            <!-- <div class="text-sky-500 text-2xl mr-7 font-bold hover:text-red-600 cursor-pointer">
            Yêu thích
            <i class="fa-solid fa-heart"></i>
          </div> -->
            <span class="mr-7">

              <el-badge :value="authStore.orderCount" class="item">
                <router-link :to="{ name: 'CartView' }">
                  <span class="text-sky-500 text-2xl font-bold hover:text-red-600 cursor-pointer pb-12">
                    Giỏ hàng
                    <i class="fa-solid fa-cart-shopping"></i>
                  </span>
                </router-link>

              </el-badge>
              <div class="cart-model">
                <span>
                  <CartModel />
                </span>
              </div>
            </span>
            <div class="">
              <el-dropdown class="focus-visible:outline-none">
                <div class="flex items-center shadow-card focus-visible:outline-none">
                  <!-- <el-avatar :src="`/images/uploads/${authStore.user?.hinhanh}`" :size="60" :icon="UserFilled"
                    class="text-5xl w-20 h-20" /> -->
                  <el-avatar :src="renderFileURL('/images/uploads/', authStore.user?.hinhanh)" :size="60"
                    :icon="UserFilled" class="text-5xl w-20 h-20" />
                </div>
                <template #dropdown>
                  <el-dropdown-menu class="w-[16rem] font-medium">
                    <router-link :to="{ name: 'UserProfile' }">
                      <el-dropdown-item>Thông Tin Tài Khoản</el-dropdown-item>
                    </router-link>
                    <el-dropdown-item @click="handleLogout()">Đăng Xuất</el-dropdown-item>
                  </el-dropdown-menu>
                </template>
              </el-dropdown>
            </div>
          </div>
        </div>
      </div>
    </header>

    <nav class="header_top">
      <div class="header_left">
        <router-link :to="{ name: 'HomeView' }">
          <span class="text-sky-500 hover:text-red-600 rounded-md px-10 py-2 text-4xl font-bold">TRANG CHỦ</span>
        </router-link>
        <span class="">
          <!-- <a href="/product"> -->
          <router-link :to="{ name: 'ProductView' }">
            <span class="text-sky-500 hover:text-red-600 rounded-md px-10 py-2 text-4xl font-bold">
              SẢN PHẨM
              <i class="fa-solid fa-chevron-down"></i>
            </span>
          </router-link>
          <!-- </a> -->
          <div class="subnav">
            <span v-for="(item, index) in state.allProductTypeData" :key="index" class="text-sky-500 hover:text-red-600"
              @click="onClickCategory(item.MaLoai, item.TenLoai)">
              {{ item.TenLoai }}</span>
          </div>
        </span>
        <router-link :to="{ name: 'NewsView' }">
          <span class="text-sky-500 hover:text-red-600 rounded-md px-10 py-2 text-4xl font-bold">TIN TỨC</span>
        </router-link>
        <router-link :to="{ name: 'ContactView' }">
          <span class="text-sky-500 hover:text-red-600 rounded-md px-10 py-2 text-4xl font-bold">LIÊN HỆ</span>
        </router-link>
      </div>
      <div class="header_right">
        <input v-model="query.TenSP" type="search" class="nhap" placeholder=" Nhập nội dung tìm kiếm ...! " />
        <button class="tim" @click="onClickSearchName(query.TenSP)">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>

      </div>
    </nav>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-2 py-2 sm:px-6 lg:px-8"></div>
    </header>
  </div>
  <div class="h-[13.4rem]"></div>
</template>
<script setup>
import CartModel from '@/components/CartModel.vue';
import { useRouter } from 'vue-router'
import { useRoute } from 'vue-router'
import { reactive, onMounted } from 'vue';
import { UserFilled } from '@element-plus/icons-vue'
import { getInformation, productTypeAll, productList } from '@/api/auth';
import { logout } from '@/api/auth';
import { removeToken } from '@/utils/auth';
import { useAuthStore } from '@/stores'
import { renderFileURL } from '@/utils/helper.js'

const state = reactive({
  user: [],
  allProductTypeData: [],
});
const router = useRouter();
const route = useRoute();
const { MaLoai, TenLoai, MinPrice, MaxPrice, page, TenSP } = route.query;
const authStore = useAuthStore();

const getInfo = async () => {
  const { data: res } = await getInformation();
  // console.log('data: ', res);
  state.user = res.data;
  if (res?.data) {
    authStore.isLogin = true;
    authStore.user = res.data;
  }
};

const query = reactive({
  MaLoai: MaLoai || '',
  TenLoai: TenLoai || '',
  MinPrice: MinPrice || 0,
  MaxPrice: MaxPrice || 100000000,
  TenSP: TenSP || '',
  page: page || 1,
})

const handleLogout = async () => {
  const { data: res } = await logout();
  if (res?.status) {
    removeToken();
    authStore.isLogin = false;
    authStore.user = {};
    router.push({
      name: 'LoginView',
    });
  }
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
}

const onClickCategory = (MaLoai, TenLoai) => {
  console.log(MaLoai);
  query.MaLoai = MaLoai;
  console.log(TenLoai);
  query.TenLoai = TenLoai;
  router.push({ name: 'ProductView', query: query })
  // getProductList()
}
const onClickSearchName = (TenSP) => {
  console.log('search name', TenSP);
  query.TenSP = TenSP;
  router.push({ name: 'ProductView', query: query })
}
onMounted(async () => {
  await getInfo();
  await getAllProductType();
});
</script>
<style lang="scss" scoped>
@import '@/style/header.scss';
</style>
