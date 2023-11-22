<script>
import axios from "axios";
import axiosInstance from "../../extensions/requestInterceptor";

export default {
  name: "FinishedTask",
  emits: ['taskDeleted'],
  props: {
    task: JSON
  },
  methods: {
    deleteTask(id) {
      axiosInstance.delete('api/tasks/' + id).then(response => {
        this.$emit('taskDeleted', id);
      });
    },
  }
}
</script>

<template>
  <div class="card-body task-done">
    <h5 class="card-title">{{ task.title }}</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">{{ task.text }}</h6>
    <p class="card-text">{{ task.created_at}}</p>
    <div>
      <button @click.prevent="deleteTask(task.id)" href="#" class="btn btn-danger ml-2">Delete</button>
    </div>
  </div>
</template>

<style scoped>
  .task-done {
    background-color: #4a5568;
  }
</style>
