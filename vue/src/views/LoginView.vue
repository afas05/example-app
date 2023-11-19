<script>
import axios from "axios";
import router from '../router/index.js'
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
      axios.defaults.withCredentials = true;
      axios.get('http://localhost/sanctum/csrf-cookie').then(response => {
        if (response.status === 204) {
          axios.post('http://localhost/login', {
              email: this.email,
              password: this.password
          }).then(response => {
            this.getUserData().then(() => {
              if (localStorage.userEmail) {
                router.push('/tasks');
              }
            });
          }).catch((error) => {
            localStorage.removeItem('userEmail');
          })
        }
      });
    },
    getUserData(skip = false) {
      let url = 'http://localhost/api/user' + (skip ? '?skip=1' : '');
      axios
        .get(url)
        .then(response => {
          localStorage.userEmail = response.data.email;
        })
    },
    skip() {
      this.getUserData(true);
      if (localStorage.userEmail) {
        router.push('/tasks');
      }
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
            <button @click.prevent="skip" class="btn btn-primary">skipp</button>
        </form>
    </main>
</template>

<style scoped>

</style>
