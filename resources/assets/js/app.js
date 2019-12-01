
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Registers
Vue.component('customerpledge',() => System.import('./components/register/CustomerPledge.vue'));
Vue.component('customercredit',() => System.import('./components/register/CustomerCredit.vue'));
Vue.component('staff',() => System.import('./components/register/StaffView.vue'));
Vue.component('payment',() => System.import('./components/register/PaymentView.vue'));
Vue.component('branchoffice',() => System.import('./components/register/BranchOffice.vue'));
Vue.component('market',() => System.import('./components/register/Market.vue'));
Vue.component('detailpledge',() => System.import('./components/register/DetailPledge.vue'));
Vue.component('contrato',() => System.import('./components/setting/ContratoBoleta.vue'));
Vue.component('montodia',() => System.import('./components/register/AmountDay.vue'));
// RegistersCustomer
Vue.component('document',() => System.import('./components/registercustomer/DocumentCustomer.vue'));
Vue.component('negocio',() => System.import('./components/registercustomer/TypeCommerce.vue'));
// SummaryDay
Vue.component('resumendia',() => System.import('./components/summaryday/ResumenDia.vue'));




Vue.component('reference',() => System.import('./components/setting/ReferenceView.vue'));
Vue.component('garmenttype',() => System.import('./components/setting/GarmenttypeView.vue'));
Vue.component('carhregister',() => System.import('./components/box/CashregisterView.vue'));
Vue.component('income',() => System.import('./components/box/IncomeView.vue'));
Vue.component('egress',() => System.import('./components/box/EgressView.vue'));

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('dashboardmain',() => System.import('./components/DashboardMain.vue'));
Vue.component('programa',() => System.import('./components/registro/mef/Programa.vue'));
Vue.component('planesestrategico',() => System.import('./components/registro/pei/PlanesEstrategicos.vue'));
Vue.component('dependencias',() => System.import('./components/registro/dependencia/Dependencias.vue'));
Vue.component('unidadespoi',() => System.import('./components/planoperativo/unidadpoi/UnidadPoiVista.vue'));
//plan operativo 
Vue.component('comboanio', () => System.import('./components/ComboAnio.vue'));

//Security 11
Vue.component('role',() => System.import('./components/security/Role.vue'));
Vue.component('user',() => System.import('./components/security/User.vue'));
Vue.component('profile',() => System.import('./components/security/Profile.vue'));
//para creditos
Vue.component('dailycollection',() => System.import('./components/operation/DailyCollectionCredit.vue'));

const app = new Vue({
    el: '#app',
    data :{
        menu : 100,
        idanio:211,
        ruta:'http://localhost:81/poi/public'
       // menu : 11
    }
});
