<template>
    <form @submit.prevent="updateProfile">
        <div class="form-group has-error">
            <label for="name" class=" col-form-label text-md-right">用户名</label>

                <input id="name" type="text"
                       v-validate="'required'"
                       :class="{'is-invalid': errors.has('name')}"
                       data-vv-as="邮箱"
                       class="form-control" v-model="name" name="name"  required>
                <span class="form-text text-muted" v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>
        <div class="form-group has-error">
            <label for="email" class=" col-form-label text-md-right">邮箱</label>

                <input id="email" type="email"
                       v-validate="'required|email'"
                       :class="{'is-invalid': errors.has('email')}"
                       data-vv-as="邮箱"
                       class="form-control" v-model="email" name="email"  required>
                <span class="form-text text-muted" v-show="errors.has('email')">{{ errors.first('email') }}</span>
        </div>

        <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    更新用户资料
                </button>
        </div>
    </form>
</template>

<script>
    import { ErrorBag } from 'vee-validate';
    import * as types from "./../../store/mutation-type";


    export default {
        created(){
          this.$store.dispatch('setAuthUser')
        },
        computed: {
            name: {
                get() {
                    return this.$store.state.AuthUser.name;
                },
                set(value){
                    this.$store.commit({
                        type: types.UPDATE_PROFILE_NAME,
                        value:value
                    })
                }
            },
            email:{
                get(){
                    return this.$store.state.AuthUser.email;
                },
                set(value){
                    this.$store.commit({
                        type: types.UPDATE_PROFILE_EMAIL,
                        value:value
                    })
                }
            }
        },
        methods: {
            updateProfile(){
                const formData = {
                    name: this.name,
                    email: this.email,
                }
                this.$store.dispatch('updateProfileRequest', formData).then(response => {
                    this.$router.push({name:'profile'})
                }).catch(error => {

                })
            }
        }
    }
</script>

<style scoped>

</style>
