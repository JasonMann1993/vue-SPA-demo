<template>
    <form @submit.prevent="login">
        <div class="form-group row has-error">
            <label for="email" class="col-md-4 col-form-label text-md-right">邮箱</label>

            <div class="col-md-6">
                <input id="email" type="email"
                       v-validate="'required|email'"
                       :class="{'is-invalid': errors.has('email')}"
                       data-vv-as="邮箱"
                       class="form-control" v-model="email" name="email"  required>
                <span class="form-text text-muted" v-show="errors.has('email')">{{ errors.first('email') }}</span>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>

            <div class="col-md-6">
                <input id="password" type="password"
                       :class="{'is-invalid': errors.has('password')}"
                       v-validate="'required|min:6'"
                       data-vv-as="密码"
                       class="form-control" v-model="password" name="password" ref="password" required>
                <span class="form-text text-muted" v-show="errors.has('password')">{{ errors.first('password') }}</span>
                <span class="form-text text-danger" v-show="bag.has('auth')">{{ bag.first('auth') }}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    登录
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import { ErrorBag } from 'vee-validate';

    export default {
        data(){
            return {
                name: '',
                email: '',
                password: '',
                bag: new ErrorBag()
            }
        },
        methods:{
            login(){
                let formData = {
                    email: this.email,
                    password: this.password
                };
                if(this.errors.any()){
                    return false;
                }
                this.$store.dispatch('loginRequest',formData).then(response => {
                    this.$router.push({name:'profile'})
                }).catch(error => {
                    if(error.response.status == 421){
                        console.log(error.response)

                        this.bag.add({
                            field: 'auth',
                            msg: '邮箱或密码错误'
                        });
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
