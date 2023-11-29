import './assets/admin/css/all.css'
import './assets/admin/css/tempusdominus-bootstrap-4.css'
import './assets/admin/css/adminlte.css'
import './assets/admin/css/rtl/bootstrap.css'
import './assets/admin/css/custom.css'


import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')
