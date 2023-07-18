import "./bootstrap";
import { createApp } from "vue";
import router from "@/router/index.js";
import App from "@/App.vue";
import VueSplide from "@splidejs/vue-splide";
import "@splidejs/vue-splide/css";
import "@/style/common.scss";
import "@/style/index.scss";
import { createPinia } from 'pinia'
import ElementPlus from "element-plus";
import Uploader from 'vue-media-upload';

const pinia = createPinia()
const app = createApp(App);

app.use(router);
app.use(pinia);
app.component('Uploader', Uploader);
app.use(VueSplide);
app.use(ElementPlus, { size: "default" });
app.mount("#home");
