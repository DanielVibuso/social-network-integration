import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state() {
    return {
      user: null,
    };
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
  },
  actions: {
    loginWithProvider({ commit }, provider) {
      window.location.href = `http://localhost/api/auth/redirect/${provider}`;
    },
    handleProviderCallback({ commit }, provider) {
      axios.get(`http://localhost/api/auth/callback/${provider}`)
        .then(response => {
          commit('setUser', response.data);
        });
    },
  },
  getters: {
    isAuthenticated(state) {
      return !!state.user;
    },
  },
});

export default store;
