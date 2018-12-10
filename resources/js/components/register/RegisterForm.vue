<template>
    <form @submit.prevent="register">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">用户名</label>

            <div class="col-md-6">
                <input id="name" type="text"
                       v-validate="'required|min:4'"
                       :class="{'is-invalid': errors.has('name')}"
                       data-vv-as="名称"
                       class="form-control" v-model="name"  name="name"  required autofocus>
                <span class="form-text text-muted" v-show="errors.has('name')">{{ errors.first('name') }}</span>
            </div>
        </div>

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
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>

            <div class="col-md-6">
                <input id="password-confirm"
                       v-validate="'required|min:6|confirmed:password'"
                       :class="{'is-invalid': errors.has('password_confirmation')}"
                       data-vv-as="确认密码"
                       type="password" class="form-control" name="password_confirmation" required>
                <span class="form-text text-muted" v-show="errors.has('password_confirmation')">{{ errors.first('password_confirmation') }}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    提交
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
          return {
              name: '',
              email: '',
              password: ''
          }
        },
        methods:{
            register(){
                let formData = {
                    name : this.name,
                    email : this.email,
                    password : this.password
                }
                if(this.errors.any()){
                    return false;
                }
                axios.post('/api/register',formData).then(response => {
                    this.$router.push({name:'confirm'})
                })
            }
        }
    }
</script>

<style scoped>

</style>
