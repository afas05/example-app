<script>
import axios from "axios";
import router from '../router/index.js'
import axiosInstance from "../../extensions/requestInterceptor";
export default {
  data() {
    return {
        email: '',
        password: ''
    };
  },
  created() {
    if (localStorage.getItem('userEmail')) {
      router.push('/tasks');
    }
  },
  methods: {
    login() {
      axiosInstance.post('login', {
          email: this.email,
          password: this.password
      }).then(response => {
        this.getUserData();
      }).catch((error) => {
        localStorage.removeItem('userEmail');
      });
    },
    getUserData(skip = false) {
      let url = 'api/user' + (skip ? '?skip=1' : '');
      axiosInstance
        .get(url)
        .then(response => {
          localStorage.userEmail = response.data.email;
          router.push('/tasks');
        })
    },
    skip() {
      this.getUserData(true);
    }
  }
};
</script>

<template>
    <main>
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input v-model="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input v-model="password" type="password" class="form-control" id="password">
            </div>
            <button @click.prevent="login" type="submit" class="btn btn-primary">Login</button>
            <button @click.prevent="skip" id="skip-login" class="btn btn-primary">Skip Login</button>
        </form>
    </main>
</template>

<style scoped>
  #skip-login {
    margin-left: 0.5rem;
  }
</style>
