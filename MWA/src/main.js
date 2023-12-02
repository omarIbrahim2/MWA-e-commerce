import './assets/admin/css/all.css'
import './assets/admin/css/tempusdominus-bootstrap-4.css'
import './assets/admin/css/adminlte.css'
import './assets/admin/css/rtl/bootstrap.css'
import './assets/admin/css/custom.css'
import './assets/admin/js/jquery.js'
import './assets/admin/js/jquery-ui.js'
$.widget.bridge('uibutton', $.ui.button)
import './assets/admin/js/rtl/bootstrap.js'
import './assets/admin/js/bootstrap.bundle.js'
import './assets/admin/js/adminlte.js'
import './assets/admin/js/dashboard.js'
import './assets/admin/js/demo.js'


import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import {Bootstrap4Pagination} from 'laravel-vue-pagination'

const app = createApp(App)

app.use(router)
app.component('Pagination' , Bootstrap4Pagination)
app.mount('#app')
