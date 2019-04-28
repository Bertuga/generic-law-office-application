<template>
	<div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <router-link :to="{ name: 'clients' }" v-if="$auth.check()" class="nav-link">Clientes</router-link>
		      </li>
		      <li class="nav-item">
		        <router-link :to="{ name: 'change-password' }" v-if="$auth.check()" class="nav-link">Alterar Senha</router-link>
		      </li>
		      <li class="nav-item">
		        <router-link :to="{ name: 'register-user' }" v-if="$auth.check(Roles.Admin)" class="nav-link">Cadastrar Usuário</router-link>
		      </li>
		      <li class="nav-item">
		        <a href="#" @click.prevent="logout" v-if="$auth.check()" class="nav-link">Logout</a>
		      </li>
		    </ul>
		  </div>
		</nav>
		<div class="container">
			<router-view></router-view>
		</div>
	</div>
</template>

<script>
	import { Roles } from './roles.js'
	export default {
		data() {
			return {
				Roles: Roles
			}
		},
		methods: {
			logout() {
				this.$auth.logout({
				    makeRequest: false,
				    redirect: '/login',
				});
			}
		}
	}
</script>

<style>
	nav { margin-bottom: 15px; }
</style>