<template>
  <div class="flex justify-center items-center w-full mt-5">
    <div class="max-w-[120rem] w-full flex mx-6">
      <div class="w-[75%] pr-12">
        <div class="flex items-center min-h-[6rem] border-b border-solid border-[#dfdfdf] py-4">
          <h1 class="text-[#1d1d1f] font-bold text-[2rem]">{{ state.news?.TieuDe }}</h1>
        </div>
        <div class="text-[1.4rem] pt-8 custom-body" v-html="state.news?.NoiDung">

        </div>
      </div>
      <div class="w-[25%]">
        <div class="flex items-center h-[6rem] border-b border-solid border-[#dfdfdf]">
          <h1 class="text-[#1d1d1f] font-bold text-[1.6rem]">Bài viết cùng danh mục</h1>
        </div>
        <div v-for="(item, index) in state.newsList" :key="index">
          <div class="flex py-5 border-b border-solid border-[#dfdfdf]">
            <router-link :to="{ name: 'NewsDetailView', params: { MaTT: item.MaTT } }">
              <div class="w-[9rem] h-[6rem] rounded-md overflow-hidden">
                <!-- <img :src="`/images/news/${item.HinhAnh}`" alt="" class="object-cover w-full h-full" /> -->
                <img :src="renderFileURL('/images/news/', item.HinhAnh)" class="object-cover w-full h-full" />
              </div>
            </router-link>
            <div class="pl-4 flex-1">
              <router-link :to="{ name: 'NewsDetailView', params: { MaTT: item.MaTT } }">
                <div class="text-[#06c] font-medium text-[1.4rem]">{{ item.TieuDe }}</div>
              </router-link>
              <div class="text-[#888] text-[1.3rem] flex items-center gap-4">
                <div>
                  <i class="fa-solid fa-calendar"></i>
                  {{ item.NgayDang }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { reactive, onMounted, watch } from "vue";
import { newsDetail, news } from "@/api/auth";
import { useRoute } from 'vue-router'
import { renderFileURL } from '@/utils/helper.js'

const route = useRoute();
const { MaTT } = route.params;

watch(
  () => route.params,
  async (newValue, oldValue) => {
    // console.log('co thay doi:', newValue)
    if (newValue.MaTT) {
      await getNewsDetail(newValue?.MaTT);
    }
  },
)

const state = reactive({
  news: {},
  newsList: {},
});

const getNewsList = async () => {
  const { data: res } = await news();
  console.log(res);
  state.newsList = res?.data;
}

const getNewsDetail = async (dataMaTT) => {
  const { data: res } = await newsDetail(dataMaTT ? dataMaTT : MaTT);
  console.log(res);
  state.news = res?.data;

}

onMounted(async () => {
  await getNewsList();
  await getNewsDetail();
});


</script>
<style lang="scss" scoped>
:deep() {
  .custom-body {
    a {
      color: -webkit-link;
      cursor: pointer;
      text-decoration: underline;
    }
  }
}
</style>
