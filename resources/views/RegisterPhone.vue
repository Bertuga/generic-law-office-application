<template>
	<div>
		<ul class="alert alert-danger" v-if="errors">
            <template v-for="errorList in errors">
              <p v-for="error in errorList">
                {{ error }}
              </p>
            </template>
        </ul>
		<h2>Telefone</h2>
		<form @submit.prevent="checkForm">
			<h3>Dados</h3>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nome">Nome:</label>
					<input type="text" class="form-control" id="nome" v-model="nome" required>
				</div>
				<div class="form-group col-md-6">
					<label for="numero">Número:</label>
					<input type="text" class="form-control" id="numero" v-model="numero" v-mask="['(##) ####-####', '(##) #####-####']">
				</div>
			</div>
			<p class="text-right"><button type="submit" class="btn btn-success">Salvar</button></p>
		</form>
	</div>
</template>

<script>
  import axios from 'axios'
  import {mask} from 'vue-the-mask'
  export default {
  	directives: {mask},
    data(){
      return {
        carregando: false,
        errors: null,
        id: null,
        id_cliente: null,
		nome: null,
		numero: null,
      }
    },
    created() {
    	this.id_cliente = this.id_client;
    	this.id = this.id_phone;
    	if(this.id !== undefined)
    		this.fetchPhone();
    },
    props: ['id_client', 'id_phone'],
    methods: {
      fetchPhone() {
      	axios
	        .get('/api/fetch-phone/' + this.id + '/' + this.id_cliente)
	        .then(response => {
	        	this.nome = response.data.nome;
				this.numero = response.data.numero;
	        })
	        .catch(e => {
	        	this.$router.replace({ name: "clients", params:{errorMsg: e.response.data.error}});
	        })
      },
      checkForm(){
        this.errors = null;
        axios
	        .post('/api/register-phone', {
	        	id: this.id,
	        	id_cliente: this.id_cliente,
	        	nome: this.nome,
				numero: this.numero,
	        })
	        .then(response => {
	        	this.$router.replace({ name: "phones", params:{id_client: this.id_cliente, successMsg: "Telefone salvo com sucesso."}});
	        })
	        .catch(e => {
			    this.errors = e.response.data.errors
	        })
      },
    }
  } 
</script>