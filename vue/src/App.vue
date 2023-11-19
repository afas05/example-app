<script setup>
import { RouterView } from 'vue-router'
import Navbar from "@/components/Navbar.vue";
import "bootstrap/dist/css/bootstrap.css"
import "bootstrap/dist/js/bootstrap"
</script>

<template>
  <header>
    <Navbar/>
  </header>

  <div class="container">
    <RouterView />
  </div>
</template>

<style scoped>

</style>
