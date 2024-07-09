import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8000/",
  headers: {
    "Content-type": "application/json",
    "Accept": "application/json"
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


export default HttpService;
