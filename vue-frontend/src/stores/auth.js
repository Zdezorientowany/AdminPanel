import {defineStore} from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
        authUser: null,
    }),
    getters: {
        user: (state) => state.authUser,
    },
    actions: {
        async getToken(){
            await axios.get('/sanctum/csrf-cookie')
        },
        async getUser(){
            await this.getToken()
            const data = await axios.get('/api/user')
            this.authUser = data.data
        },
        async login(data){
            await this.getToken()
            await axios.post('/login', {
                email: data.email,
                password: data.password
            })
            this.router.push({name: 'Home'})
        },
        async logout(){
            await axios.post('/logout')
            this.authUser = null
        }

    }
})