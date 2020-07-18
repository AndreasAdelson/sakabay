/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import $ from 'jquery';
import Vue from 'vue';
import {
  BootstrapVue,
  IconsPlugin
} from 'bootstrap-vue';
import Toto from './components/toto';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

new Vue({
  el: '#app',
  components: {
    Toto
  }
})

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
