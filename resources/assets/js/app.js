import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

require('./bootstrap');

window.Vue = require('vue');

import FootStatHeader from './components/FootStatHeader';
import HomePage from './components/HomePage';
 
new Vue({
    el: '#app',
    components: {
       FootStatHeader,
       HomePage
    },
    
    data: {
        leagues: {},
    },
    
    created() {
        this.getLeagues();
    },
    
    methods: {
        getLeagues() {
            axios.get('/api/leagues')
            .then(response => {
                this.leagues = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
    
});
