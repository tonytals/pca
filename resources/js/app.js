/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'Vuex';
Vue.use(Vuex);

/*
 * VUEX
 */

const store = new Vuex.Store({
    state : {
      itens : {}
    },


    mutations : {
      setItens (state, obj){
        state.itens = obj;
      }
    },

    actions : {
      markAsRead(context, params){
        axios.put('/notificacoes-read', params)
      }
    }

});

/*
 * FIM DO VUEX
 */


Vue.filter('formataData', function (value) {
  var dataVigencia = new Date(value);
  return ("0" + dataVigencia.getDate()).slice(-2) + '/' + ("0" + (dataVigencia.getMonth() + 1)).slice(-2) + '/' +  dataVigencia.getFullYear();
});

Vue.filter('striptag', function (value) {
  var div = document.createElement("div");
  div.innerHTML = value;
  var text = div.textContent || div.innerText || "";
  return text.substring(0,27) + '...';
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('notificacoes', require('./components/default/Notificacoes.vue'));
Vue.component('tarefas', require('./components/default/Tarefas.vue'));
Vue.component('menu-principal', require('./components/default/MenuPrincipal.vue'));
Vue.component('tabela-de-listagem', require('./components/TabelaDeListagem.vue'));
Vue.component('painel', require('./components/Painel.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('modal-link', require('./components/ModalLink.vue'));
Vue.component('formulario', require('./components/Formulario.vue'));
// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })
import VueTimeago from 'vue-timeago';

Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'pt-BR', // Default locale
  locales: {
    'pt-BR': require('date-fns/locale/pt'),
  }
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
