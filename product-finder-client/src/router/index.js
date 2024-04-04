import { createRouter, createWebHistory } from 'vue-router'
import MainView from '../views/MainView.vue';
import UserList from '@/components/main/UserList.vue';
import ProductList from '@/components/main/ProductList.vue';
import ViewProduct from '@/components/main/products/ViewProduct.vue';
import Auth from '@/components/login/Auth.vue';

const routes = [
  {
    path: '/',
    name: 'login',
    component: Auth
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
        path:'users',
        component:UserList,
      },
      {
        path:'products',
        component:ProductList,
        children:[
          {
            path:':productId', 
            component: ViewProduct,

          }
        ],
      }
    ],
  }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
