<template>
	<div>
        <div class="alert alert-danger" v-if="error">
            <p>{{ this.error }}</p>
        </div>
        <form autocomplete="off" @submit.prevent="change_password" method="post">
            <div class="form-group">
                <label for="old_password">Senha antiga</label>
                <input type="old_password" id="old_password" name="old_password" class="form-control" v-model="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Senha nova</label>
                <input type="new_password" id="new_password" name="new_password" class="form-control" v-model="new_password" required>
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
        error: false
      }
    },
    methods: {
      change_password(){
        axios.post('/auth/change-password', {
          old_password: this.old_password,
          new_password: this.new_password
        })
        .then(response => {
            alert('ok');
        })
        .catch(e => {
          this.error = e.response.data.msg
        })    
      },
    }
  } 
</script>