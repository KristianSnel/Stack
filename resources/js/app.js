require('./bootstrap');

window.Vue = require('vue');

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('albums', require('./components/Albums.vue').default);

const app = new Vue({
	el: '#app'
});