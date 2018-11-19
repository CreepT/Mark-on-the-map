<template>
  <div id="app">
    <app-header/>
    <div clas="router-content">
     <router-view></router-view>
    </div>
    <app-footer/>
  </div>
</template>

<script>

import AppHeader from './components/header.vue'
import AppFooter from './components/footer.vue'

export default {
  name: 'app',
  components: {
    AppHeader,
    AppFooter
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}


</script>

<style>

body {
  height: 100vh;
}

#app {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: inherit;
  font-family: Roboto, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}

.router-content{
  text-align: center;
}
</style>
