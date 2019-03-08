<template>
	<div>
        <ul class="alert alert-danger" v-if="errors">
            <template v-for="errorList in errors">
              <p v-for="error in errorList">
                {{ error }}
              </p>
            </template>
        </ul>
        <div class="alert alert-success" v-if="success">
            <p>Senha alterada com sucesso.</p>
        </div>
        <form autocomplete="off" @submit.prevent="change_password" method="post">
            <div class="form-group">
                <label for="senha_antiga">Senha antiga</label>
                <input type="password" id="senha_antiga" name="senha_antiga" class="form-control" v-model="senha_antiga" required>
            </div>
            <div class="form-group">
                <label for="senha_nova">Senha nova</label>
                <input type="password" id="senha_nova" name="senha_nova" class="form-control" v-model="senha_nova" required>
            </div>
            <input type="submit" class="btn btn-default" value="Entrar"/>
        </form>
    </div>
</template>

<script>
  import axios from 'axios'
  export default {
    data(){
      return {
        senha_antiga: null,
        senha_nova: null,
        errors: null,
        success: false,
      }
    },
    methods: {
      change_password(){
        this.success = false;
        this.errors = null;
        axios.post('api/auth/change-password', {
          senha_antiga: this.senha_antiga,
          senha_nova: this.senha_nova
        })
        .then(response => {
            this.success = true;
            this.errors = null;
            this.senha_antiga = null;
            this.senha_nova = null;
        })
        .catch(e => {
          this.success = false;
          console.log(e.response.data.errors)
          this.errors = e.response.data.errors
        })    
      },
    }
  } 
</script>

<style>
  .alert > p { margin-bottom: 0px; }
</style>