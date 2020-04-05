import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import FootApp from './FootApp'

Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

require('./bootstrap');

window.Vue = require('vue');

new Vue({
    el: '#App',
    template: '<FootApp/>',
    components: { FootApp }
});
