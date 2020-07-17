/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import  BootstrapVue from 'bootstrap-vue'
import Vue from 'vue';
// import Bootstrap from 'bootstrap';
import Toto from './components/toto';
import ListTest from './components/list_test';

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin


new Vue({ el: '#app',
components:{
    Toto,ListTest,
}
})

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
