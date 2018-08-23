import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({

  state: {
    hasToken: !!localStorage.getItem("token"),
    token: localStorage.getItem("token"),
    user: localStorage.getItem("user"),
    userIsPendingSync: false
  },

  mutations: {
    logout: state => {
      state.hasToken = false;
    },
    tokenSet: state => {
      state.hasToken = true;
    },
    syncUser: state => {
      state.userIsPendingSync = true;
    },
    userSynced: state => {
      state.userIsPendingSync = false;
    }
  },

  actions: {
    withToken: ({ commit }, payload) => {
      return new Promise(resolve => {
        localStorage.setItem("token", payload.token);
        commit("tokenSet");
        resolve();
      });
    },
    syncUser: ({ commit, state, dispatch }, payload) => {
      commit("syncUser");

      return new Promise((resolve, reject) => {
        setTimeout(() => {
          axios.defaults.headers.Authorization = 'Bearer ' + payload.token;
          axios.get(process.env.VUE_APP_API_URL + '/me').then(response => {
            let data = response.data.data;
            localStorage.setItem("user", JSON.stringify(data));
            commit("userSynced");
            resolve();
          }).catch(error => {
            commit("userSynced");
            dispatch("logout");
            resolve();
          });
        }, 3000);
      });
    },
    syncUserWithToken: ({ commit, state, dispatch }, payload) => {
      return dispatch("withToken", payload).then(() => {
        return dispatch("syncUser", payload);
      });
    },
    logout: ({ commit }) => {
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      setTimeout(() => {
        commit("logout");
      }, 500);
    }
  },

  getters: {
    hasToken: state => {
      return state.hasToken;
    },
    user: state => {
      return JSON.parse(state.user);
    },
    userIsPendingSync: state => {
      return state.userIsPendingSync;
    }
  }

});
