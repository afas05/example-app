<script>
import axios from "axios";
import axiosInstance from "../../extensions/requestInterceptor";

export default {
  name: "EditTask",
  emits: ['taskUpdated', 'taskCreated'],
  props: {
    task: JSON
  },
  data() {
    return {
      title: this.$props.task.title,
      text: this.$props.task.text,
      errors: {}
    };
  },
  methods: {
    saveChanges() {
      this.errors = {};
      axiosInstance.patch(
        'api/tasks/' + this.$props.task.id,
        {
          title: this.title,
          text: this.text
        }
      ).then(response => {
        this.$emit('taskUpdated', this.title, this.text);
      }).catch(error => {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
      });
    },
    createTask() {
      this.errors = {};

      axiosInstance.post('api/tasks', {
        title: this.title,
        text: this.text
      }).then(response => {
        this.$emit('taskCreated', response.data.data);
      }).catch(error => {
        if (error.response) {
          this.errors = error.response.data.errors;
        }
      });
    }
  }
}
</script>

<template>
  <div class="card-body">
    <input v-model="title" class="form-control mb-2" :class="{'is-invalid': errors.title}">
    <input v-model="text" class="form-control mb-2" :class="{'is-invalid': errors.text}">
    <p class="text-muted text-sm-end">{{ task.created_at}}</p>
    <div>
      <button v-if="task.id === 'new'" @click.prevent="createTask()" href="#" class="btn btn-primary">Add</button>
      <button v-else @click.prevent="saveChanges()" href="#" class="btn btn-primary">Save</button>
    </div>
  </div>
</template>

<style scoped>

</style>
