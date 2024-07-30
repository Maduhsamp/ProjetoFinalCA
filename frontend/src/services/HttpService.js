import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8000/api",
  headers: {
    "Content-type": "application/json",
    Accept: "application/json"
  },
});

export const login = (user) => {
  return HttpService.post('login', user);
}

export const getUser = () => {

  const currentUser = store.getters.currentUser;

  console.log(currentUser);

  const headers = {
    Authorization: `Bearer ${currentUser.access_token}`
  };

  return HttpService.get('user', { headers });
}

export const getName = async () => {
  const { data } = await HttpService.get(`login/name`);
  return data.user.name;
};

export const getFunil = async (page) => {
  const { data } = await HttpService.get(`funil?page=${page}`);
  return data.funis;
};

export const getContato = async (id) => {
  const { data } = await HttpService.get(`funil/${id}/contato`);
  return data.contatos;
};

export const show = async (id) => {
  const { data } = await HttpService.get(`funil/${id}`);
  return data.funil;
};

export const showContato = async (funilId, contatoId) => {
  const { data } = await HttpService.get(`funil/${funilId}/contato/${contatoId}`);
  return data.contato;
};

HttpService.interceptors.request.use(config => {
  const token = JSON.parse(localStorage.getItem('access_token'));
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default HttpService;
