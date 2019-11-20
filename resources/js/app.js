require('./bootstrap');

window.Vue = require('vue');




Vue.component('albums', require('./components/Albums.vue').default);

const app = new Vue({
	el: '#app'
});