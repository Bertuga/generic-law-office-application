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
					<td><router-link :to="{ name: 'register-client', params: {id_cliente: id} }" class="btn btn-primary float-right">Editar</router-link></td>
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