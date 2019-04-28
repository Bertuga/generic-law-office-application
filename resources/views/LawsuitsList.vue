<template>
	<div>
		<h2>Processos <router-link :to="{ name: 'register-lawsuit' }" class="btn btn-primary float-right">+ Processo</router-link></h2>
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
					<td>Número</td>
					<td></td>
				</tr>
			</thead>
			<tbody v-if="processos">
				<tr v-for="{ id, id_cliente, numero } in processos">
					<td>{{ numero }}</td>
					<td class="text-right">
						<router-link :to="{ name: 'register-lawsuit', params: {id_lawsuit: id, id_client: id_cliente} }" class="btn btn-primary">Editar</router-link>
						<button @click="deleteLawsuit(id)" class="btn btn-danger">Excluir</button>
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
        processos: null,
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
      deleteLawsuit(id) {
      	if(confirm('Deseja realmente excluir esse processo?')) {
      		axios
      			.post('/api/delete-lawsuit', {id: id})
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
        this.processos = null;
        axios
	        .get('/api/list-lawsuits/' + this.id_cliente)
	        .then(response => {
	        	this.processos = response.data;
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