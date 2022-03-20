import home from './component/home';

require('./bootstrap');

import {createApp} from 'vue';
import {createWebHashHistory} from 'vue-router';
import Consultation from './component/Consultation';
import first_vaccination from './component/first_vaccination';
import detail from './component/detail';

const login = require('./component/login').default;
const {createRouter, createWebHistory} = require('vue-router');

const routes = [
    { path:'/' , component: login },
    { path:'/home' , component: home , meta : { requiresToken:true }},
    { path:'/consultation' , component: Consultation , meta : { requiresToken:true }},
    { path:'/first_vaccination' , component: first_vaccination , meta : { requiresToken:true }},
    { path:'/detail/:id' , component: detail , meta : { requiresToken:true }}
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

router.beforeEach( async (to , from , next) => {
    let token = localStorage.getItem('token');
    if (to.meta.requiresToken){
        if (!token){
            return next('/')
        }
        window.axios.defaults.params = {}
        window.axios.defaults.params['token'] = token
    }

    return next()
})
const App = createApp({
})

App.use(router)

App.mount('#app')
