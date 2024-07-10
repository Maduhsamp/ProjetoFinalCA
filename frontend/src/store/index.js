import { createStore } from "vuex";
import HttpService from '@/services/HttpService';

export default createStore({
  state: {
    accessToken: JSON.parse(localStorage.getItem('access_token')) || '',
  },
  getters: {
    Logged(state){
      return state.accessToken != null && state.accessToken !== '';
    }
  },
  mutations: {
    updateStorage(state, accessToken){
      state.accessToken = accessToken;
      localStorage.setItem('access_token', JSON.stringify(accessToken));
    },
    destroyToken(state){
      state.accessToken = '';
      localStorage.removeItem('access_token');
      console.log('Token removido');
    }
  },
  actions: {
    async Login(context, user) {
      return new Promise(async (resolve, reject) => {
        try {
          const response = await HttpService.post('/api/login', user);
          context.commit('updateStorage', response.data.access_token);
          resolve();
        } catch (error) {
          reject(error);
        }
      });
    },
    async LogOut(context){
      if (context.getters.Logged) {
        try {
          await HttpService.post('/api/logout');
          context.commit('destroyToken');
          console.log('Logout bem-sucedido');
        } catch (error) {
          console.log('Erro ao fazer logout:', error);
        }
      }
    }
  },
  modules: {},
});
