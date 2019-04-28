<template>
	<div>
		<h2>Clientes <router-link :to="{ name: 'register-client' }" class="btn btn-primary float-right">+ Cliente</router-link></h2>
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
					<td>RG</td>
					<td>Data de Nascimento</td>
					<td>CPF</td>
					<td>Cidade</td>
					<td></td>
				</tr>
			</thead>
			<tbody v-if="clientes">
				<tr v-for="{ id, nome, rg, nascimento, cpf, cidade } in clientes">
					<td>{{ nome }}</td>
					<td>{{ rg }}</td>
					<td>{{ nascimento }}</td>
					<td>{{ cpf }}</td>
					<td>{{ cidade }}</td>
					<td class="text-right">
						<router-link :to="{ name: 'phones', params: {id_client: id} }" class="btn btn-primary">Contatos</router-link>
						<router-link :to="{ name: 'register-client', params: {id_client: id} }" class="btn btn-primary">Editar</router-link>
						<button v-if="$auth.check(Roles.Admin)" @click="deleteClient(id)" class="btn btn-danger">Excluir</button>
					</td>
				</tr>
			</tbody>
        </table>
    </div>
</template>

<script>
  import axios from 'axios'
  import { Roles } from '../js/roles.js'
  export default {
    data(){
      return {
      	Roles: Roles,
        carregando: false,
        clientes: null,
        error: this.errorMsg,
        success: this.successMsg
      }
    },
    created() {
    	this.fetchData();
    },
    props: ['errorMsg', 'successMsg'],
    methods: {
      deleteClient(id) {
      	if(confirm('Deseja realmente excluir esse cliente?') && confirm('Isso vai excluir dados de contato e processos. Deseja realmente continuar?')) {
      		axios
      			.post('api/delete-client', {id: id})
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
        this.clientes = null;
        axios
	        .get('api/list-clients')
	        .then(response => {
	        	this.clientes = response.data;
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