import Layout from '@/layouts/index.vue';
import Home from '@/pages/Home.vue';
import Login from '@/pages/user-profile/Login.vue';
import Register from '@/pages/user-profile/Register.vue';
import UserProfile from '@/pages/user-profile/index.vue';
import RegisterSuccess from '@/pages/user-profile/RegisterSuccess.vue';
import VerifyEmail from '@/pages/verify-mail/VerifyEmail.vue';
import VerifyEmailError from '@/pages/verify-mail/VerifyEmailError.vue';
import ForgotPassword from '@/pages/user-profile/ForgotPassword.vue';
import ResetPassword from '@/pages/user-profile/ResetPassword.vue';
import SentForgotPassword from '@/pages/user-profile/SentForgotPassSuccess.vue';
import Product from '@/pages/product/Product.vue';
import ProductDetail from '@/pages/product/ProductDetail.vue';
import News from '@/pages/news/News.vue';
import NewsDetail from '@/pages/news/NewsDetail.vue';
import Contact from '@/pages/Contact.vue';
import Cart from '@/pages/Cart.vue';
import Checkout from '@/pages/Checkout.vue';
import PaymentReturn from '@/pages/payment/PaymentReturn.vue';
import PaymentMoMoReturn from '@/pages/payment/PaymentMoMoReturn.vue';
import PaymentSuccess from '@/pages/payment/PaymentSuccess.vue';
import PaymentError from '@/pages/payment/PaymentError.vue';
import OrderDetail from '@/pages/OrderDetail.vue';



const path = [
    {
        path: '/',
        component: Layout,
        children: [
            {
                path: '',
                name: 'HomeView',
                component: Home,
            },
            {
                path: 'login',
                name: 'LoginView',
                component: Login,
            },
            {
                path: 'register',
                name: 'RegisterView',
                component: Register,
            },
            {
                path: 'product',
                name: 'ProductView',
                component: Product,
            },
            {
                path: 'product-detail',
                name: 'ProductDetailView',
                component: ProductDetail,
            },
            {
                path: 'news',
                name: 'NewsView',
                component: News,
            },
            {
                path: 'news-detail/:MaTT',
                name: 'NewsDetailView',
                component: NewsDetail,
            },
            {
                path: 'contact',
                name: 'ContactView',
                component: Contact,
            },
            {
                path: 'cart',
                name: 'CartView',
                component: Cart,
            },
            {
                path: 'product-detail/:MaSP',
                name: 'ProductDetailView',
                component: ProductDetail,
            },
            {
                path: 'checkout',
                name: 'CheckoutView',
                component: Checkout,
            },
            {
                path: 'profile',
                name: 'UserProfile',
                component: UserProfile,
            },
            {
                path: 'return-vnpay',
                name: 'PaymentReturnView',
                component: PaymentReturn,
            },
            {
                path: 'return-momo',
                name: 'PaymentMoMoReturnView',
                component: PaymentMoMoReturn,
            },
            {
                path: 'payment-success',
                name: 'PaymentSuccessView',
                component: PaymentSuccess,
            },
            {
                path: 'payment-error',
                name: 'PaymentErrorView',
                component: PaymentError,
            },
            {
                path: 'order-detail/:MaDH',
                name: 'OrderDetailView',
                component: OrderDetail,
            },
            {
                path: 'register-success',
                name: 'RegisterSuccessView',
                component: RegisterSuccess,
            },
            {
                path: 'verify/:token',
                name: 'VerifyEmailView',
                component: VerifyEmail,
            },
            {
                path: 'verify-email-error',
                name: 'VerifyEmailErrorView',
                component: VerifyEmailError,
            },
            {
                path: 'reset-password/:token',
                name: 'ResetPasswordView',
                component: ResetPassword,
            },
            {
                path: 'forgot-password',
                name: 'ForgotPasswordView',
                component: ForgotPassword,
            },
            {
                path: 'forgot-password/sent-email',
                name: 'SentForgotPasswordView',
                component: SentForgotPassword,
            },
            { path: '/:pathMatch(.*)*', redirect: '/404', hidden: true },
        ], 
        
    },
    {
        path: '/404',
        name: '404',
        component: () => import('@/components/404.vue'),
    }
    
];
export default path;