import {createRouter, createWebHistory} from 'vue-router'
import {useAuthStore} from '../stores/auth.js'
import Home from '../components/Home.vue'

function isAdmin(to, from, next){
    const authStore = useAuthStore()
    if(authStore.user != null){ 
        if(authStore.user.role === 'admin'){
            next()
        }else{
            next({name: 'Home'})
        }
    }else{
        next({name: 'Home'})
    }
}

function isUser(to, from, next){
    const authStore = useAuthStore()
    if(authStore.user != null){ 
        if(authStore.user.role === 'user'){
            next()
        }else{
            next({name: 'Home'})
        }
    }else{
        next({name: 'Home'})
    }
}

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
        meta: {requiresAdmin: true},
        component: () => import('../components/Users/UserPanel.vue'),

    },
    {
        path: '/content-panel',
        name: 'CONTENTPANEL',
        meta: {requiresAdmin: true},
        component: () => import('../components/Content/ContentPanel.vue'),

    },

]


const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAdmin){
        isAdmin(to, from, next)
    }else if(to.meta.requiresUser){
        isUser(to, from, next)
    }else{
        next()
    }
});

export default router