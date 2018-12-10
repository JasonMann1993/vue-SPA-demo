<template>
   <div class="container">
       <div class="notification">
           <transition name="fade">
               <div class="alert" :class="notificationLevel"
                    v-if="msg"
                    @click="hideNotification()">
                   <button
                       type="button"
                       class="close"
                       data-dismiss="alert"
                       aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   {{msg}}
               </div>
           </transition>
       </div>
   </div>
</template>

<script>
    import {mapState,mapActions} from 'vuex'
    export default{
        computed:{
            ...mapState({
                level:state => state.Notification.level,
                msg:state => state.Notification.msg
            }),
            notificationLevel(){
                return 'alert-' + this.level
            }
        },
        methods:{
            ...mapActions([
                'hideNotification'
            ])
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
