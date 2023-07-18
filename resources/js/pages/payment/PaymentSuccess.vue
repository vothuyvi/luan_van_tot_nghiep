<template>
  <div class="max-w-[120rem] w-full mx-auto">
    <div class="flex items-center justify-center my-[10rem] flex-col">
      <div class="w-[5rem]">
        <svg width="50" height="50" viewBox="0 0 390 389" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M368.455 215.212C354.558 284.699 302.165 350.128 228.647 364.749C192.792 371.889 155.597 367.535 122.36 352.307C89.1226 337.079 61.5369 311.753 43.5307 279.935C25.5245 248.117 18.0157 211.429 22.0735 175.095C26.1313 138.761 41.5488 104.634 66.1308 77.5722C116.551 22.0382 201.686 6.75099 271.173 34.5458"
            stroke="#0ea5e9" stroke-width="41.6923" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M132.2 187.416L201.687 256.903L368.456 76.2368" stroke="#0ea5e9" stroke-width="41.6923"
            stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
      <h1 class="text-[4rem] mt-6 text-[#0ea5e9]">Thành Công</h1>
      <div class="text-3xl mt-2">Đơn hàng của bạn đã được thanh toán thành công</div>
      <router-link :to="{ name: 'ProductView' }">
        <el-button type="success bg-[#0ea5e9] hover:bg-[#56c0f0] mt-8" round size="large" color="#0ea5e9">
          Tiếp tục mua sắm
        </el-button>
      </router-link>

    </div>
  </div>
</template>
<script setup></script>
<style lang="scss" scoped>
.cs-shadow {
  box-shadow: 0px 2px 16px #eeebeb;
}
</style>
