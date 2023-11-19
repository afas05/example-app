<script>
import {RouterLink} from "vue-router";
import router from '../router/index.js'
export default {
  name: "Navbar",
  components: {RouterLink},
  data() {
    return {
      loggedIn: false
    }
  },
  created() {
    this.loggedIn = localStorage.getItem('userEmail') !== null;
  },
  methods: {
    logout() {
      localStorage.removeItem('userEmail');
      router.push('/login');
    }
  }
}
</script>

<template>
  <nav class="navbar navbar-expand-lg" style="background-color: #434a9f;">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">Task Maker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tasks">Tasks</a>
        </li>
        <li v-if="!loggedIn" class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li v-else class="nav-item">
          <a @click.prevent="logout" class="nav-link" href="/logout">Logout</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
</template>

<style scoped>
  .navbar a {
    color: white;
  }
  .navbar-nav .nav-link.active {
    color: #9ca3af;
  }
</style>
