<template>
	<div>
		<ul class="alert alert-danger" v-if="errors">
            <template v-for="errorList in errors">
              <p v-for="error in errorList">
                {{ error }}
              </p>
            </template>
        </ul>
		<h2>Processo</h2>
		<form @submit.prevent="checkForm">
			<h3>Dados</h3>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="numero">Número:</label>
					<input type="text" class="form-control" id="numero" v-model="numero">
				</div>
			</div>
			<p class="text-right"><button type="submit" class="btn btn-success">Salvar</button></p>
		</form>
	</div>
</template>

<script>
  import axios from 'axios'
  export default {
    data(){
      return {
        errors: null,
        id: null,
        id_cliente: null,
		numero: null,
      }
    },
    created() {
    	this.id_cliente = this.id_client;
    	this.id = this.id_lawsuit;
    	if(this.id !== undefined)
    		this.fetchLawsuit();
    },
    props: ['id_client', 'id_lawsuit'],
    methods: {
      fetchLawsuit() {
      	axios
	        .get('/api/fetch-lawsuit/' + this.id + '/' + this.id_cliente)
	        .then(response => {
				this.numero = response.data.numero;
	        })
	        .catch(e => {
	        	this.$router.replace({ name: "clients", params:{errorMsg: e.response.data.error}});
	        })
      },
      checkForm(){
        this.errors = null;
        axios
	        .post('/api/register-lawsuit', {
	        	id: this.id,
	        	id_cliente: this.id_cliente,
				numero: this.numero,
	        })
	        .then(response => {
	        	this.$router.replace({ name: "lawsuits", params:{id_client: this.id_cliente, successMsg: "Processo salvo com sucesso."}});
	        })
	        .catch(e => {
			    this.errors = e.response.data.errors
	        })
      },
    }
  } 
</script>