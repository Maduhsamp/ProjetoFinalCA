import { createStore } from "vuex";
import HttpService from '@/services/HttpService';

export default createStore({
  state: {
    accessToken: JSON.parse(localStorage.getItem('access_token')) || '',
  },
  getters: {
    Logged(state){
      return state.accessToken != null;
    }
  },
  mutations: {
    updateStorage(state, accessToken){
      state.accessToken = accessToken;
      localStorage.setItem('access_token', JSON.stringify(accessToken));
    },
    destroyToken(state){
      state.accessToken = null;
      localStorage.removeItem('access_token');
    }
  },
  actions: {
    async Login(context, user) {
      return new Promise(async (resolve, reject) => {
        try {
          const response = await HttpService.post('/api/login', user);
          context.commit('updateStorage', response.data.access_token);
          console.log(response);
          resolve();
        } catch (error) {
          reject(error);
        }
      });
    },
    async LogOut(context){
      if(context.getters.Logged){
        context.commit('destroyToken')
      }
    }
  },
  modules: {},
});
