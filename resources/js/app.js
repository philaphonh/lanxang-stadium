require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;
window.VueMoment = require('vue-moment').default;
window.Axios = require('axios');
window.VueAxios = require('vue-axios');

Vue.use(VueRouter);
Vue.use(VueMoment);
Vue.use(VueAxios, Axios);

Axios.defaults.baseURL = 'http://localhost:8000';

Vue.component('Navbar', require('./components/NavbarComponent.vue').default);
Vue.component('Banner', require('./components/BannerComponent.vue').default);
Vue.component('Footerr', require('./components/FooterComponent.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./pages/HomePage.vue').default
        },
        {
            path: '/stadium',
            name: 'stadium',
            component: require('./pages/StadiumPage.vue').default
        },
        {
            path: '/schedule',
            name: 'schedule',
            component: require('./pages/ReservationSchedulePage.vue').default
        },
        {
            path: '/contact',
            name: 'contact',
            component: require('./pages/ContactPage.vue').default
        },
        {
            path: '/aboutus',
            name: 'aboutus',
            component: require('./pages/AboutUsPage.vue').default
        },
        {
            path: '/login',
            name: 'login',
            component: require('./pages/AdminLoginPage.vue').default,
            meta: {
                auth: false
            }
        },
        {
            path: '/logout',
            name: 'logout',
            component: require('./pages/AdminLogoutPage.vue').default,
            meta: {
                auth: true
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: require('./pages/AdminDashboardPage.vue').default,
            beforeEnter: (to, from, next) => {
                if (localStorage.getItem('admin') === '' || localStorage.getItem('admin') === null) {
                    next('/login');
                } else {
                    next();
                }
            },
            meta: {
                auth: true
            }
        },
        {
            path: '*',
            name: '404',
            component: require('./pages/404Page.vue').default
        }
    ]
});

Vue.router = router;

// Vue.use(require('@websanova/vue-auth'), {
//     auth: require('@websanova/vue-auth/drivers/auth/bearer'),
//     http: require('@websanova/vue-auth/drivers/http/axios.1.x'),
//     router: require('@websanova/vue-auth/drivers/router/vue-router.2.x')
// });

const app = new Vue({
     el: '#app',
     router: Vue.router
});
