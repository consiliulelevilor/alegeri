import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({

  state: {
    isLoggedIn: !!localStorage.getItem("token"),
    token: localStorage.getItem("token"),
    user: null,
    userIsPendingSync: false
  },

  mutations: {
    logout: state => {
      state.isLoggedIn = false;
    },
    tokenSet: state => {
      state.isLoggedIn = true;
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
    syncUser: ({ commit, state, dispatch }) => {
      commit("syncUser");

      return new Promise(resolve => {
        if (! state.isLoggedIn) {
          localStorage.setItem("user", null);
          commit("userSynced");
          resolve();
        } else {
          axios.defaults.headers.Authorization = 'Bearer ' + state.token;

          axios.get(process.env.VUE_APP_API_URL + '/me').then(response => {
            let data = response.data.data;
            state.user = data.data;
            resolve();
          }).catch(error => {
            commit("userSynced");
            dispatch("logout");
            resolve();
          });
        }
      });
    },
    logout: ({ commit }) => {
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      commit("logout");
    }
  },

  getters: {
    isLoggedIn: state => {
      return state.isLoggedIn;
    },
    user: state => {
      return state.user;
    },
    token: state => {
      return state.token;
    }
  }

});
