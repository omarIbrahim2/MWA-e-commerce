import { createRouter, createWebHistory } from 'vue-router'
import CatsView from '../views/admin/CatsView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      name: 'cats',
      path: '/cats',
      component:CatsView
    }
    
    
  ]
})

export default router
