import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8000/",
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

export const getName = async() => {
  const {data} = await HttpService.get(`api/login/name`);
  return data.user.name;
};


HttpService.interceptors.request.use(config => {
  const token = JSON.parse(localStorage.getItem('access_token'));
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default HttpService;
