<template>
	<div>
        <div class="alert alert-danger" v-if="error">
            <p>Houve um erro ao autenticar, verifique suas credenciais.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control" v-model="password" required>
            </div>
            <input type="submit" class="btn btn-default" value="Entrar"/>
        </form>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function () {
            	this.error = false;
            },
            error: function () {
            	this.error = true;
            },
            rememberMe: true,
            redirect: '/home',
            fetchUser: true,
        });       
      },
    }
  } 
</script>