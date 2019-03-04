<template>
	<div>
        <div class="alert alert-danger" v-if="error">
            <p>{{ this.error }}</p>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Senha alterada com sucesso.</p>
        </div>
        <form autocomplete="off" @submit.prevent="change_password" method="post">
            <div class="form-group">
                <label for="old_password">Senha antiga</label>
                <input type="password" id="old_password" name="old_password" class="form-control" v-model="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Senha nova</label>
                <input type="password" id="new_password" name="new_password" class="form-control" v-model="new_password" required>
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
        old_password: null,
        new_password: null,
        error: false,
        success: false,
      }
    },
    methods: {
      change_password(){
        this.success = false;
        this.error = false;
        axios.post('api/auth/change-password', {
          old_password: this.old_password,
          new_password: this.new_password
        })
        .then(response => {
            this.success = true;
            this.error = false;
            this.old_password = null;
            this.new_password = null;
        })
        .catch(e => {
          this.success = false;
          this.error = e.response.data.msg
        })    
      },
    }
  } 
</script>