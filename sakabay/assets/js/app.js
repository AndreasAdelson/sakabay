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


import $ from 'jquery';
import Vue from 'vue';
import * as VeeValidate from 'vee-validate';
import VueLoaders from 'vue-loaders';
import MultiSelect from 'vue-multiselect';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import { Icon } from 'leaflet';
import vuescroll from 'vuescroll';

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
import FormCategory from './components/admin/category/form';
import ShowCategory from './components/admin/category/show';
import ListCategory from './components/admin/category';
import FormCompanyStatut from './components/admin/companystatut/form';
import ShowCompanyStatut from './components/admin/companystatut/show';
import ListCompanyStatut from './components/admin/companystatut';
import RegisterCompanyForm from './components/company/register/form';
import RegisterCompany from './components/company/register';
import ListCompanySubscribed from './components/admin/company/subscribed';
import CompanySubscribedShow from './components/admin/company/subscribed/show';
import ListCompanyRegistered from './components/admin/company/registered';
import CompanyRegisteredShow from './components/admin/company/registered/show';
import CompanyAdminForm from './components/admin/company/form';
import CompanyListing from './components/company/list';
import CompanyShow from './components/company/show';
import FormCity from './components/admin/city/form';
import ShowCity from './components/admin/city/show';
import ListCity from './components/admin/city';
import moment from 'moment';
import Dashboard from './components/dashboard';
import Abonnement from './components/company/abonnement';
import Subscription from './components/subscription';
import Premium from './components/subscription/premium';
import 'utils/logger';

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
Vue.use(vuescroll, {
  ops: {
    mode: 'native',
    sizeStrategy: 'percent',
    detectResize: true,
    /** Enable locking to the main axis if user moves only slightly on one of them at start */
    locking: true,
  },
});

Vue.prototype.$vuescrollConfig = {
  bar: {
    background: ' #f39c12',
    size: '6px',
    minSize: 0.3,
    keepShow: true
  },
  rail: {
    background: '#c5c9cc',
    opacity: 0.6,
    size: '6px',
    specifyBorderRadius: false,
    gutterOfEnds: '1px',
    gutterOfSide: '2px',
    keepShow: false
  },
};

delete Icon.Default.prototype._getIconUrl;
Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png').default,
  iconUrl: require('leaflet/dist/images/marker-icon.png').default,
  shadowUrl: require('leaflet/dist/images/marker-shadow.png').default,
});

Vue.component('Multiselect', MultiSelect);
Vue.component('VMap', LMap);
Vue.component('VTileLayer', LTileLayer);
Vue.component('VMarker', LMarker);

new Vue({
  el: '#root',
  i18n,
  components: {
    Premium,
    Subscription,
    Abonnement,
    ShowCategory,
    ListCategory,
    ListCompanyStatut,
    ShowCompanyStatut,
    FormCompanyStatut,
    FormCategory,
    RegisterCompanyForm,
    RegisterCompany,
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
    CompanyAdminForm,
    CompanyRegisteredShow,
    CompanyListing,
    CompanyShow,
    ShowCity,
    ListCity,
    FormCity,
    Dashboard
  }
});

moment.locale('fr');
global.$ = global.jQuery = $;

$(document).ready(() => {
  // Bootstrap tooltips
  $('[data-toggle="tooltip"]').tooltip();
});
