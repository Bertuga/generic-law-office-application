<template>
	<div>
		<h2>Telefones <router-link :to="{ name: 'register-phone' }" class="btn btn-primary float-right">+ Telefone</router-link></h2>
		<div class="loading" v-if="carregando">
			Carregando...
		</div>
        <p class="alert alert-danger" v-if="this.error">
            {{ this.error }}
        </p>
        <p class="alert alert-success" v-if="this.success">
            {{ this.success }}
        </p>

        <table class="table table-hover table-bordered">
			<thead class="thead-dark">
				<tr>
					<td>Nome</td>
					<td>Número</td>
					<td></td>
				</tr>
			</thead>
			<tbody v-if="telefones">
				<tr v-for="{ id, id_cliente, nome, numero } in telefones">
					<td>{{ nome }}</td>
					<td>{{ numero }}</td>
					<td class="text-right">
						<router-link :to="{ name: 'register-phone', params: {id_phone: id, id_client: id_cliente} }" class="btn btn-primary">Editar</router-link>
						<button @click="deletePhone(id)" class="btn btn-danger">Excluir</button>
					</td>
				</tr>
			</tbody>
        </table>
    </div>
</template>

<script>
  import axios from 'axios'
  export default {
    data(){
      return {
        carregando: false,
        id_cliente: null,
        telefones: null,
        error: this.errorMsg,
        success: this.successMsg
      }
    },
    created() {
    	this.id_cliente = this.id_client;
    	this.fetchData();
    },
    props: ['errorMsg', 'successMsg', 'id_client'],
    methods: {
      deletePhone(id) {
      	if(confirm('Deseja realmente excluir esse telefone?')) {
      		axios
      			.post('/api/delete-phone', {id: id})
		        .then(response => {
		        	this.success = response.data.message;
		        	this.fetchData();
		        })
		        .catch(e => {
		            this.errorMsg = e.response.data.error;
		        }) 
      	}
      },
      fetchData(){
        this.telefones = null;
        axios
	        .get('/api/list-phones/' + this.id_cliente)
	        .then(response => {
	        	this.telefones = response.data;
	        })
	        .catch(e => {
	          this.error = "Falha ao carregar registros";
	        })    
      },
    }
  } 
</script>

<style>
  .alert > p { margin-bottom: 0px; }
</style>