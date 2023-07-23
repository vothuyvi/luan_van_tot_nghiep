import { createRouter, createWebHistory } from "vue-router";
import path from "@/router/path.js";

const routes = [...path];
  
const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior: to => {
    if (to.hash) {
      return { el: to.hash };
    } else {
      return { top: 0 };
    }
  },
});
// router.beforeEach((to, from, next) => {
//   if(to.name == '404'){
//     next();
//   }
//   if(!to.name) {
//     next('/404');
//   }
// });

export default router;