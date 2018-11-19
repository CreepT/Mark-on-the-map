import Vue from 'vue'
import App from './App.vue'

import VueRouter from 'vue-router'

Vue.use(VueRouter);


// routes
import Index from "./routes/Index.vue";
import Profile from "./routes/Profile.vue";
import About from "./routes/About.vue";
import Marks from "./routes/Marks.vue";
import Settings from "./routes/Settings.vue";
import Users from "./routes/Users.vue";


function ifAuthenticated() {
  console.log(1);
}


let router = new VueRouter({
  routes: [
    { path: "/", component: Index },
    { path: "/profile", component: Profile, beforeEnter: ifAuthenticated, },
    { path: "/about", component: About },
    { path: "/marks", component: Marks },
    { path: "/settings", component: Settings },
    { path: "/users", component: Users }
  ]
});



new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
})
