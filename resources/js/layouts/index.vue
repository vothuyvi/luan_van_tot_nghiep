<template>
    <Header />
    <router-view></router-view>
    <ChatZalo />
    <Footer />
</template>
<script setup>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import ChatZalo from "@/components/ChatZalo.vue";

</script>