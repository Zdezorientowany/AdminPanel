import {createRouter, createWebHistory} from 'vue-router'
import Home from '../components/Home.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../components/Login.vue')
    },
    {
        path: '/user-panel',
        name: 'USERPANEL',
        component: () => import('../components/Users/UserPanel.vue')
    },
    {
        path: '/content-panel',
        name: 'CONTENTPANEL',
        component: () => import('../components/Content/ContentPanel.vue')
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router