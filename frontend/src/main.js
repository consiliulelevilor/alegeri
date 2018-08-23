import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import Argon from "./plugins/argon-kit";
import store from "./store";
import axios from 'axios';

Vue.config.productionTip = false;

Vue.use(Argon);

axios.defaults.headers = {
  'Content-Type': 'application/json',
  Accepts: 'application/json'
};

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
