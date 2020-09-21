/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css');
import 'es6-promise/auto';
import 'bootstrap';
import 'babel-polyfill';

import $ from 'jquery';
import Vue from 'vue';
import * as VeeValidate from 'vee-validate';
import VueLoaders from 'vue-loaders';
import MultiSelect from 'vue-multiselect';

import {
  BootstrapVue,
  IconsPlugin
} from 'bootstrap-vue';
import ListUser from './components/admin/utilisateur';
import EditUser from './components/admin/utilisateur/form';
import ShowUser from './components/admin/utilisateur/show';
import EditAccount from './components/utilisateur/editAccount';
import Home from './components/home';
import SousNavBar from './components/commons/navBar';
import cnsRenderUtils from './plugins/cnsRenderUtils';
import cnsFormUtils from 'plugins/cnsFormUtils';
import i18n from 'plugins/i18n';
import Avatar from 'vue-avatar';
import ListFonction from './components/admin/fonction';
import FormFonction from './components/admin/fonction/form';
import ListRole from './components/admin/role';
import FormRole from './components/admin/role/form';
import ShowRole from './components/admin/role/show';
import ListGroup from './components/admin/group';
import FormGroup from './components/admin/group/form';
import ShowGroup from './components/admin/group/show';
import FormCategory from './components/category/form';
import ShowCategory from './components/category/show';
import ListCategory from './components/category';
import FormCompanyStatut from './components/admin/companystatut/form';
import ShowCompanyStatut from './components/admin/companystatut/show';
import ListCompanyStatut from './components/admin/companystatut';
import Company from './components/company';
import ListCompanySubscribed from './components/admin/company/subscribed';
import CompanySubscribedShow from './components/admin/company/subscribed/show';
import CompanySubscribedForm from './components/admin/company/subscribed/form';
import ListCompanyRegistered from './components/admin/company/registered';
import CompanyRegisteredShow from './components/admin/company/registered/show';
import CompanyRegisteredForm from './components/admin/company/registered/form';



Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(cnsRenderUtils);
Vue.use(cnsFormUtils);
Vue.use(VueLoaders);
Vue.use(MultiSelect);

Vue.use(VeeValidate, {
  inject: true,
  events: '', // Automatic validation is desactivated
  fieldsBagName: 'veeFields',
  errorBagName: 'errors'
});

Vue.component('multiselect', MultiSelect);

new Vue({
  el: '#app',
  i18n,
  components: {
    ShowCategory,
    ListCategory,
    ListCompanyStatut,
    ShowCompanyStatut,
    FormCompanyStatut,
    FormCategory,
    Company,
    Avatar,
    EditUser,
    ListUser,
    ShowUser,
    Home,
    SousNavBar,
    EditAccount,
    ListFonction,
    FormFonction,
    FormRole,
    ShowRole,
    ListRole,
    FormGroup,
    ListGroup,
    ShowGroup,
    ListCompanySubscribed,
    ListCompanyRegistered,
    CompanySubscribedShow,
    CompanySubscribedForm,
    CompanyRegisteredShow,
    CompanyRegisteredForm
  }
});

global.$ = global.jQuery = $;
