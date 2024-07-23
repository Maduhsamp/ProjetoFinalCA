import { createApp } from 'vue'
import App from './App.vue'
import Toast, { POSITION } from 'vue-toastification';
import router from './router'
import store from "./store";

import "bootstrap/dist/css/bootstrap.min.css";
import 'vue-toastification/dist/index.css';
import "bootstrap";


const options = {
  position: POSITION.TOP_RIGHT,
  timeout: 3000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: false,
  closeButton: 'button',
  icon: true,
  rtl: false
};

const app = createApp(App)

app.use(router)
app.use(store)
app.use(Toast, options);

app.mount('#app')
