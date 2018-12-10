<template>
    <form @submit.prevent="updatePassword">
        <div class="form-group">
            <label for="password" class=" col-form-label text-md-right">密码</label>

                <input id="password" type="password"
                       :class="{'is-invalid': errors.has('password')}"
                       v-validate="'required|min:6'"
                       data-vv-as="密码"
                       class="form-control" v-model="password" name="password" ref="password" required>
                <span class="form-text text-muted" v-show="errors.has('password')">{{ errors.first('password') }}</span>
        </div>

        <div class="form-group">
            <label for="password-confirm" class=" col-form-label text-md-right">确认密码</label>

                <input id="password-confirm"
                       v-validate="'required|min:6|confirmed:password'"
                       :class="{'is-invalid': errors.has('password_confirmation')}"
                       data-vv-as="确认密码"
                       type="password" class="form-control" name="password_confirmation" required>
                <span class="form-text text-muted" v-show="errors.has('password_confirmation')">{{ errors.first('password_confirmation') }}</span>
        </div>

        <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    更新密码
                </button>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
            return {
                password: '',
            }
        },
        methods:{
            updatePassword() {
                if(this.errors.any()){
                    return false;
                }
                let formData = {
                    password: this.password
                };
                this.$store.dispatch('updatePasswordRequest',formData).then(response => {
                    // this.$router.push({name:'profile'})
                }).catch(error => {
                    console.log(error.message)
                })
            }
        }
    }
</script>

<style scoped>

</style>
