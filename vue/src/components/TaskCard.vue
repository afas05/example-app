<script>
import axios from "axios";

export default {
  name: "TaskCard",
  emits: ['edit', 'taskFinished', 'taskDeleted'],
  props: {
    task: JSON
  },
  methods: {
    deleteTask(id) {
      axios.delete('http://localhost/api/tasks/' + id).then(response => {
        this.$emit('taskDeleted', id);
      });
    },
    markFinished() {
      axios.patch(
        'http://localhost/api/tasks/' + this.$props.task.id + '/done',
        {
          is_done: true
        }
      ).then(response => {
        this.$emit('taskFinished', this.$props.task.id);
      });
    }
  }
}
</script>

<template>
  <div class="card-body">
    <h5 class="card-title">{{ task.title }}</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">{{ task.text }}</h6>
    <p class="card-text">{{ task.created_at}}</p>
    <div class="action-buttons">
      <button @click.prevent="markFinished()" href="#" class="btn btn-primary">Done</button>
      <button @click.prevent="$emit('edit', task)" href="#" class="btn btn-primary">Edit</button>
      <button @click.prevent="deleteTask(task.id)" href="#" class="btn btn-danger ml-2">Delete</button>
    </div>
  </div>
</template>

<style scoped>

</style>
