<template>
	<div>
		<h2>Cliente</h2>
		<form>
			<h3>Dados Pessoais</h3>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nome">Nome:</label>
					<input type="text" class="form-control" id="nome" v-model="nome" required>
				</div>
				<div class="form-group col-md-6">
					<label for="email">E-mail:</label>
					<input type="text" class="form-control" id="email" v-model="email">
				</div>
				<div class="form-group col-md-4">
					<label for="nascimento">Data de Nascimento:</label>
					<input type="text" class="form-control" id="nascimento" v-model="nascimento" required>
				</div>
				<div class="form-group col-md-4">
					<label for="rg">RG:</label>
					<input type="text" class="form-control" id="rg" v-model="rg" required>
				</div>
				<div class="form-group col-md-4">
					<label for="cpf">CPF:</label>
					<input type="text" class="form-control" id="cpf" v-model="cpf" required>
				</div>
			</div>
			<h3>Endereço</h3>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="endereco">Endereço:</label>
					<input type="text" class="form-control" id="endereco" v-model="endereco" required>
				</div>
				<div class="form-group col-md-2">
					<label for="numero">Número:</label>
					<input type="text" class="form-control" id="numero" v-model="numero" required>
				</div>
				<div class="form-group col-md-4">
					<label for="complemento">Complemento:</label>
					<input type="text" class="form-control" id="complemento" v-model="complemento">
				</div>
				<form-group class="col-md-3">
					<label for="bairro">Bairro:</label>
					<input type="text" class="form-control" id="bairro" v-model="bairro" required>
				</form-group>
				<form-group class="col-md-3">
					<label for="cidade">Cidade:</label>
					<input type="text" class="form-control" id="cidade" v-model="cidade" required>
				</form-group>
				<form-group class="col-md-3">
					<label for="estado">Estado:</label>
					<input type="text" class="form-control" id="estado" v-model="estado" required>
				</form-group>
				<form-group class="col-md-3">
					<label for="cep">Cep:</label>
					<input type="text" class="form-control" id="cep" v-model="cep" required>
				</form-group>
			</div>
		</form>
	</div>
</template>

<script>
  import axios from 'axios'
  export default {
    data(){
      return {
        carregando: false,
        errors: null,
		id: null,
		nome: null,
		rg: null,
		nascimento: null,
		cpf: null,
		endereco: null,
		numero: null,
		complemento: null,
		bairro: null,
		cidade: null,
		estado: null,
		cep: null,
		email: null
      }
    }/*,
    created() {
    	this.fetchData();
    },
	watch: {
		'$route': 'fetchData'
	},
    methods: {
      fetchData(){
            this.error = this.clientes = null;
        axios
	        .get('api/list-clients')
	        .then(response => {
	        	this.clientes = response.data;
	        })
	        .catch(e => {
	          this.error = "Falha ao carregar registros";
	        })    
      },
    }*/
  } 
</script>