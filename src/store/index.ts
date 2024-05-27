import { createStore } from 'vuex'
import axios from 'axios';
import { Address } from '@/types';

export default createStore({
  state: {
    address: null,
    loading: false,
    error: null,
  },
  mutations: {
    SET_ADDRESS(state, address) {
      state.address = address;
    },
    SET_LOADING(state, loading) {
      state.loading = loading;
    },
    SET_ERROR(state, error) {
      state.error = error;
    },
  },
  actions: {
    async zipSearch({ commit }, zipCode) {
      commit('SET_LOADING', true);
      commit('SET_ERROR', null);
      const host = process.env.VUE_APP_API_HOST || window.location.host;
      axios.get<Address>(`http://${host}/api/zip/${zipCode}`)
          .then(response => {
            commit('SET_ADDRESS', response.data)
            commit('SET_LOADING', false);
          })
          .catch(err => {
            commit('SET_LOADING', false);
            if (err.response?.status === 404) {
              commit('SET_ERROR', 'CEP não encontrado')
              return;
            }
            if (err instanceof Error) {
              commit('SET_ERROR', 'Erro ao buscar o CEP: ' + err.message)
              return
            }
          });
    },
  },
  getters: {
    address: (state) => state.address,
    loading: (state) => state.loading,
    error: (state) => state.error,
  },
  modules: {
  }
})
