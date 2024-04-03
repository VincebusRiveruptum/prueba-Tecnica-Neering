import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import MainView from '../views/MainView.vue';
import UserList from '@/components/main/UserList.vue';
import ProductList from '@/components/main/ProductList.vue';

const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginView
  },
  {
    path: '/',
    name: 'main',
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: MainView,
    children:[
      {
        path:'home',
        //component:UserList,
      },
      {
        path:'users',
        component:UserList,
      },
      {
        path:'products',
        component:ProductList,
      }
    ],
  }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
