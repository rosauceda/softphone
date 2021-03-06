import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import Vuex from 'vuex'
import VueLoading from "vuejs-loading-plugin";

Vue.config.productionTip = false

Vue.use(Vuex)

Vue.use(VueLoading, {
    //dark: true, // default false
    text: 'Loading ...', // default 'Loading'
    loading: false, // default false
    //customLoader: myVueComponent, // replaces the spinner and text with your own
    //background: 'rgb(215,255,215)', // set custom background
    classes: ['myclass'] // array, object or string
});

new Vue({
  router,
  store,
    vuetify,
  render: h => h(App)
}).$mount('#app')
