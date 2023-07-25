<template>
  <div class="container__login">
    <div class="container__login-body">
      <div class="login-body__header">
        <span>Đăng nhập thành viên</span>
      </div>
      <div v-if="state.error" class="text-red-600 text-xl font-medium">{{ state.error }}</div>
      <div class="login-body__center">
        <div class="login">
          <span>Tên đăng nhập</span>
          <input v-model="state.email" type="email" name="" id="" class="fontAwesome"
            placeholder=" &#xf0e0;  Enter your email" />
        </div>
        <div class="login">
          <span>Mật khẩu</span>
          <input v-model="state.password" type="password" class="fontAwesome"
            placeholder=" &#xf023;  Enter your password" />
        </div>
      </div>
      <div class="login-body__bot">
        <button @click="handleLogin()">Đăng nhập</button>
        <router-link :to="{ name: 'ForgotPasswordView' }">
          <div class="text-red-600 text-xl font-bold mb-6 mt-2 cursor-pointer">
            Quên mật khẩu?
          </div>
        </router-link>
        <div class="login-body-bot__signup">
          <div class="text-xl text-black-600">
            Bạn chưa có tài khoản?
            <router-link :to="{ name: 'RegisterView' }">
              <b class="text-sky-500 hover:text-red-600">Đăng ký tại đây</b>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { setToken } from '@/utils/auth';
import { login, forgotPassword } from '@/api/auth';
import { ElMessage } from 'element-plus'
import { useAuthStore } from '@/stores'

const authStore = useAuthStore();
const router = useRouter();
const state = reactive({
  email: '',
  password: '',
  error: '',
});

const checkValidate = () => {
  if (state.email === '') {
    ElMessage({
      message: 'Vui lòng nhập email.',
      type: 'error',
      grouping: true,
    })
    return false;
  }
  if (!isEmailValid(state.email)) {
    ElMessage({
      message: 'Email không đúng định dạng',
      type: 'error',
      grouping: true,
    })
    return false;
  }
  if (state.password === '') {
    ElMessage({
      message: 'Vui lòng nhập mật khẩu.',
      type: 'error',
      grouping: true,
    })
    return false;
  }

  return true;
}

const isEmailValid = (email) => {
  const re =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

const handleLogin = async () => {
  try {
    const form = {
      email: state.email,
      password: state.password,
    };
    if (checkValidate()) {
      const { data: res } = await login(form);
      if (res?.data) {
        setToken(res?.data.token);
        // console.log('token', res.data.token);
        authStore.user = res?.data?.users
        authStore.isLogin = true
        state.error = null;
        ElMessage({
          message: 'Đăng nhập thành công!',
          type: 'success',
          grouping: true,
        })
        router.push({
          name: 'HomeView',
        });
      }
    }

  } catch (error) {
    console.log(error);
    console.log(error.response.data);
    state.error = error.response.data.message;
  }
};

</script>
<style lang="scss" scoped>
@import '@/style/login.scss';
</style>
