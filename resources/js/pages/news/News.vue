<template>
  <div class="flex justify-center items-center w-full">
    <div class="max-w-[120rem] w-full flex mx-6">
      <div class="w-[75%] pr-12">
        <!-- HEADER -->
        <div class="flex items-center h-[6rem] border-b border-solid border-[#dfdfdf]">
          <h1 class="text-[#1d1d1f] font-bold text-[2rem]">Tin tức</h1>
        </div>
        <!-- CONTENT -->
        <div class="">
          <div v-for="(item, index) in state.newsList" :key="index"
            class="flex py-8 border-b border-solid border-[#dfdfdf]">
            <!-- ITEM_IMAGE -->
            <div class="w-[15rem] h-[12rem] rounded-lg overflow-hidden">
              <router-link :to="{ name: 'NewsDetailView', params: { MaTT: item.MaTT } }">
                <img :src="`/images/news/${item.HinhAnh}`" alt="" class="object-cover w-full h-full" />
              </router-link>

            </div>
            <!-- ITEM_CONTENT -->
            <div class="flex-1 pl-6">
              <router-link :to="{ name: 'NewsDetailView', params: { MaTT: item.MaTT } }">
                <div class="text-[#06c] font-bold text-[1.5rem]">{{ item.TieuDe }}</div>
              </router-link>

              <div class="text-[#888] text-[1.3rem] flex items-center gap-4">
                <div>
                  <i class="fa-solid fa-calendar"></i>
                  {{ item.NgayDang }}
                </div>
                <!-- <div>
                  <i class="fa-solid fa-eye"></i>
                  158 lượt xem
                </div> -->
              </div>
              <div class="text-[#888] text-[1.3rem] text-clamp">
                {{ stripHtml(item.NoiDung) }}
              </div>
            </div>
          </div>
          <!-- <div class="my-8 flex justify-center">
            <el-pagination background layout="prev, pager, next" :total="" :page-size="2"
              @current-change="handleCurrentChange" />
          </div> -->
        </div>
      </div>
      <div class="w-[25%]">
        <div class="flex items-center h-[6rem] border-b border-solid border-[#dfdfdf]">
          <h1 class="text-[#1d1d1f] font-bold text-[1.6rem]">Tin tức mới nhất</h1>
        </div>
        <div v-for="(item, index) in state.newsList" :key="index">
          <div class="flex py-5 border-b border-solid border-[#dfdfdf]">
            <router-link :to="{ name: 'NewsDetailView', params: { MaTT: item.MaTT } }">
              <div class="w-[9rem] h-[6rem] rounded-md overflow-hidden">
                <img :src="`/images/news/${item.HinhAnh}`" alt="" class="object-cover w-full h-full" />
              </div>
            </router-link>
            <div class="pl-4 flex-1">
              <router-link :to="{ name: 'NewsDetailView', params: { MaTT: item.MaTT } }">
                <div class="text-[#06c] font-medium text-[1.4rem] text-clamp">{{ item.TieuDe }}</div>
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
import { reactive, onMounted } from "vue";
import { news } from "@/api/auth";
import { useRoute } from 'vue-router';

const state = reactive({
  newsList: {},
});


const getNewsList = async () => {
  const { data: res } = await news();
  console.log('newss', res);
  if (res?.data) {
    state.newsList = res?.data;
  }
}

const stripHtml = html => {
  let tmp = document.createElement('DIV');
  tmp.innerHTML = html;
  return tmp.textContent || tmp.innerText || '';
};

onMounted(async () => {
  await getNewsList();
});

</script>
<style lang="scss" scoped>
.text-clamp {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: pre-wrap;
  word-break: break-word;
}
</style>
