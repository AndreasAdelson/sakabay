/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
import '../css/app.css';
import $ from 'jquery';
import Vue from 'vue';
import * as VeeValidate from 'vee-validate';
import {
  BootstrapVue,
  IconsPlugin
} from 'bootstrap-vue';
import Login from './components/utilisateur/login';
import ListUser from './components/admin/utilisateur';
import EditUser from './components/admin/utilisateur/form';
import EditAccount from './components/utilisateur/editAccount';
import Home from './components/home/home';
import ExampleForm from './components/example/form';
import SousNavBar from './components/commons/navBar';
import cnsRenderUtils from './plugins/cnsRenderUtils';
import cnsFormUtils from 'plugins/cnsFormUtils';
import i18n from 'plugins/i18n';


Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(cnsRenderUtils);
Vue.use(cnsFormUtils);

Vue.use(VeeValidate, {
  inject: true,
  events: '', // Automatic validation is desactivated
});

new Vue({
  el: '#app',
  i18n,
  components: {
    EditUser,
    ListUser,
    Login,
    Home,
    ExampleForm,
    SousNavBar,
    EditAccount
  }
})


console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
