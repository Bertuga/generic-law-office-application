<template>
	<div>
        <div class="alert alert-danger" v-if="error">
            <p>{{ this.error }}</p>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Usuário cadastrado com sucesso.</p>
        </div>
        <form autocomplete="off" @submit.prevent="register" method="post">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="name" id="name" name="name" class="form-control" v-model="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control" v-model="password" required>
            </div>
            <input type="submit" class="btn btn-default" value="Cadastrar"/>
        </form>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        name: null,
        email: null,
        password: null,
        error: false,
        success: false,
      }
    },
    methods: {
      register(){
        var app = this
        this.success = false;
        this.error = false;
        this.$auth.register({
            params: {
              name: app.name,
              email: app.email,
              password: app.password
            }, 
            success: function () {
              this.error = false;
              this.success = true;
              this.name = null;
              this.email = null;
              this.password = null;
            },
            error: function (response) {
              this.error = response;
              this.success = false;
            },
            redirect: null,
        });       
      },
    }
  } 
</script>