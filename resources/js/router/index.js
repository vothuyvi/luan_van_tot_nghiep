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
//   if (localStorage.getItem(TOKEN_LOGIN)) {
//       if (WHITE_LIST.includes(to.name)) {
//           next('/checkout');
//       } else {
//           next('');
//       }
//   } else {
//       if (WHITE_LIST.includes(to.name)) {
//           next();
//       } else {
//           next('/login');
//       }
//   }
// });

export default router;