import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

axios.default.baseURL = 'http://localhost:8000/api'

import App from './App.vue'
import Home from '../views/Home'
import Login from '../views/Login'

const router = new VueRouter({
	mode: 'history',
	routes: [{
		path: '/',
		redirect: '/home'
	},{
		path: '/login',
		name: 'login',
		component: Login,
		meta: {
			auth: false,
			notFoundRedirect: '/home',
		},
	},
	{
		path: '/home',
		name: 'home',
		component: Home,
		meta: {
			auth: true
		},
	}]
});

Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

const app = new Vue({
	el: '#app',
	components: { App },
	router,
});