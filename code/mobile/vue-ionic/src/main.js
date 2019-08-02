import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import IonicVue from '@ionic/vue';

Vue.config.productionTip = false

import '@ionic/core/css/core.css';
import '@ionic/core/css/ionic.bundle.css';

Vue.use(IonicVue);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
