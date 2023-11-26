import './assets/main.css'

import { createApp } from 'vue'
import Dashboard from './components/Dashboard.vue'
import router from './router'

const app = createApp(Dashboard)

app.use(router)

app.mount('#app')
