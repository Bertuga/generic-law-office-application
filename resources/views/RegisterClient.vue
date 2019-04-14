<template>
	<div>
		<ul class="alert alert-danger" v-if="errors">
            <template v-for="errorList in errors">
              <p v-for="error in errorList">
                {{ error }}
              </p>
            </template>
        </ul>
		<h2>Cliente {{ this.id }}</h2>
		<form @submit.prevent="checkForm">
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
				<div class="col-md-3">
					<label for="bairro">Bairro:</label>
					<input type="text" class="form-control" id="bairro" v-model="bairro" required>
				</div>
				<div class="col-md-3">
					<label for="cidade">Cidade:</label>
					<input type="text" class="form-control" id="cidade" v-model="cidade" required>
				</div>
				<div class="col-md-3">
					<label for="estado">Estado:</label>
					<input type="text" class="form-control" id="estado" v-model="estado" required>
				</div>
				<div class="col-md-3">
					<label for="cep">Cep:</label>
					<input type="text" class="form-control" id="cep" v-model="cep" required>
				</div>
			</div>
			<p><button type="submit">Salvar</button></p>
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
		email: null,
      }
    },
    created() {
    	this.id = this.id_cliente;
    	if(this.id !== undefined)
    		this.fetchClient();
    },
    props: ['id_cliente'],
    methods: {
      fetchClient() {
      	axios
	        .get('/api/fetch-client/' + this.id)
	        .then(response => {
	        	this.nome = response.data.nome;
				this.rg = response.data.rg;
				this.nascimento = response.data.nascimento;
				this.cpf = response.data.cpf;
				this.endereco = response.data.endereco;
				this.numero = response.data.numero;
				this.complemento = response.data.complemento;
				this.bairro = response.data.bairro;
				this.cidade = response.data.cidade;
				this.estado = response.data.estado;
				this.cep = response.data.cep;
				this.email = response.data.email;
	        })
	        .catch(e => {
	        	this.$router.replace({ name: "clients", params:{errorMsg: e.response.data.error}});
	        })
      },
      checkForm(){
        this.errors = null;
        axios
	        .post('/api/register-client', {
	        	id: this.id,
	        	nome: this.nome,
				rg: this.rg,
				nascimento: this.nascimento,
				cpf: this.cpf,
				endereco: this.endereco,
				numero: this.numero,
				complemento: this.complemento,
				bairro: this.bairro,
				cidade: this.cidade,
				estado: this.estado,
				cep: this.cep,
				email: this.email,
	        })
	        .then(response => {
	        	this.$router.replace({ name: "clients", params:{successMsg: "Cliente salvo com sucesso."}});
	        })
	        .catch(e => {
			    this.errors = e.response.data.errors
	        })
      },
    }
  } 
</script>