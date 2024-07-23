import { createStore } from "vuex";
import { useToast } from 'vue-toastification';
import HttpService from '@/services/HttpService';

export default createStore({
  state: {
    accessToken: JSON.parse(localStorage.getItem('access_token')) || '',
    isModalVisible: false,
    isModalDeleteVisible: false
  },
  getters: {
    Logged(state) {
      return state.accessToken != null && state.accessToken !== '';
    },
    isModalVisible(state) {
      return state.isModalVisible;
    },
    isModalDeleteVisible(state) {
      return state.isModalDeleteVisible;
    }
  },
  mutations: {
    updateStorage(state, accessToken) {
      state.accessToken = accessToken;
      localStorage.setItem('access_token', JSON.stringify(accessToken));
    },
    destroyToken(state) {
      state.accessToken = '';
      localStorage.removeItem('access_token');
      console.log('Token removido');
    },
    show_modal(state) {
      state.isModalVisible = true;
    },
    hide_modal(state) {
      state.isModalVisible = false;
    },
    show_delete_modal(state) {
      state.isModalDeleteVisible = true;
    },
    hide_delete_modal(state) {
      state.isModalDeleteVisible = false;
    }
  },
  actions: {
    async Login(context, user) {
      return new Promise(async (resolve, reject) => {
        try {
          const response = await HttpService.post('/login', user);
          context.commit('updateStorage', response.data.access_token);
          resolve();
        } catch (error) {
          reject(error);
        }
      });
    },
    async LogOut(context) {
      const toast = useToast();
      if (context.getters.Logged) {
        try {
          await HttpService.post('/logout');
          context.commit('destroyToken');
          toast.success('Logout realizado com sucesso!');
        } catch (error) {
          toast.error('Erro ao fazer logout, tente novamente!', error);
        }
      }
    },
    showModal({ commit }) {
      commit('show_modal');
    },
    hideModal({ commit }) {
      commit('hide_modal');
    },
    showDeleteModal({ commit }) {
      commit('show_delete_modal');
    },
    hideDeleteModal({ commit }) {
      commit('hide_delete_modal');
    }
  },
  modules: {},
});
