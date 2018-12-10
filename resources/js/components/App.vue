<template>
    <div>
        <top-menu></top-menu>
        <notification></notification>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    import TopMenu from './common/TopMenu';
    import Notification from './common/Notification';
    import jwtToken from './../helpers/jwt';
    import Cookie from 'js-cookie'

    export default {
        created() {
            if(jwtToken.getToken()){
                this.$store.dispatch('setAuthUser').then(response => {

                }).catch(error => {
                    console.log(error.message)
                })
            }else if(Cookie.get('auth_id')){
                this.$store.dispatch('refreshToken')
            }
        },
        components: {
            TopMenu,
            Notification
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
