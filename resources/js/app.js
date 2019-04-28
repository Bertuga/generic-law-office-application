import './bootstrap'
import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

axios.default.baseURL = 'http://localhost:8000/api'

import { Roles } from './roles.js'
import App from './App.vue'
import Login from '../views/Login'
import ChangePassword from '../views/ChangePassword'
import RegisterUser from '../views/RegisterUser'
import ClientsList from '../views/ClientsList'
import RegisterClient from '../views/RegisterClient'
import PhonesList from '../views/PhonesList'
import RegisterPhone from '../views/RegisterPhone'
import LawsuitsList from '../views/LawsuitsList'
import RegisterLawsuit from '../views/RegisterLawsuit'

const router = new VueRouter({
	mode: 'history',
	routes: [{
		path: '/',
		redirect: '/clients'
	},{
		path: '/login',
		name: 'login',
		component: Login,
		meta: {
			auth: false,
			notFoundRedirect: '/clients',
		},
	},
	{
		path: '/change-password',
		name: 'change-password',
		component: ChangePassword,
		meta: {
			auth: true
		},
	},
	{
		path: '/register-user',
		name: 'register-user',
		component: RegisterUser,
		meta: {
			auth: {roles: Roles.Admin}
		},
	},
	{
		path: '/clients',
		name: 'clients',
		component: ClientsList,
		props: true,
		meta: {
			auth: true
		},
	},
	{
		path: '/register-client/:id_client?',
		name: 'register-client',
		component: RegisterClient,
		props: true,
		meta: {
			auth: true
		},
	},
	{
		path: '/phones/:id_client',
		name: 'phones',
		component: PhonesList,
		props: true,
		meta: {
			auth: true
		},
	},
	{
		path: '/register-phone/:id_phone/:id_client',
		name: 'register-phone',
		component: RegisterPhone,
		props: true,
		meta: {
			auth: true
		},
	},
	{
		path: '/lawsuits/:id_client',
		name: 'lawsuits',
		component: LawsuitsList,
		props: true,
		meta: {
			auth: true
		},
	},
	{
		path: '/register-lawsuit/:id_lawsuit/:id_client',
		name: 'register-lawsuit',
		component: RegisterLawsuit,
		props: true,
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
	rolesVar: 'role',
	registerData: {url: 'api/auth/register'},
	loginData: {url: 'api/auth/login'},
	logoutData: {url: 'api/auth/logout'},
	fetchData: {url: 'api/auth/user'},
	refreshData: {url: 'api/auth/refresh'}
});

const app = new Vue({
	el: '#app',
	components: { App },
	router,
});
