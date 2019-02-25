<template>
	<div>
		<p>
			<router-link :to="{ name: 'home' }" v-if="$auth.check()">Home</router-link>
			<a href="#" @click.prevent="logout" v-if="$auth.check()">Logout</a>
		</p>
		<div class="container">
			<router-view></router-view>
		</div>
	</div>
</template>

<script>
	export default {
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