<template>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top mb-4">
        <div class="container">
            <router-link to="/" class="navbar-brand">Vue-SPA</router-link>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <router-link v-if="!user.authenticated" to="/login" tag="li">
                        <a class="nav-link">登录</a>
                    </router-link>
                    <router-link v-if="!user.authenticated" to="/register" tag="li">
                        <a class="nav-link">注册</a>
                    </router-link>
                    <router-link v-if="user.authenticated" to="/profile" tag="li">
                        <a class="nav-link">个人中心</a>
                    </router-link>
                    <li v-if="user.authenticated" >
                        <a class="nav-link" @click.prevent="logout" href="#">退出</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapState} from 'vuex'
    export default{
        computed:{
            ...mapState({
                user:state => state.AuthUser
            })
        },
        methods:{
            logout(){
                this.$store.dispatch('logoutRequest').then(response => {
                    this.$router.push({name:'home'})
                })
            }
        }
    }
</script>
