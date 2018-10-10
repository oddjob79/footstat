require('./bootstrap');

window.Vue = require('vue');

import FootStatHeader from './components/FootStatHeader';
import HomePage from './components/HomePage';
 
new Vue({
    el: '#app',
    components: {
       FootStatHeader,
       HomePage
    }
});
