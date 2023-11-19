<script>
import axios from "axios";
import TaskList from "@/components/TaskList.vue";

export default {
  name: "MainView",
  emits: ['newTaskAdded'],
  components: {TaskList},
  data() {
    return {
      tasks: []
    };
  },
  methods: {
    getTasks() {
      axios.get('http://localhost/api/tasks').then(response => {
        this.tasks = response.data.data;
      })
    },
    addNewTask() {
      let newTask = {title: '', text: '', id: 'new'};
      this.tasks.push(newTask);
      this.$refs.taskList.edit(newTask);
    }
  },
  created() {
    this.getTasks();
  }
}
</script>

<template>
  <main>
    <div class="col-12 mt-3">
      <button @click="addNewTask()" class="btn btn-primary">+</button>
    </div>
    <div class="col-12">
      <TaskList
        :tasks="tasks"
        ref="taskList"
      />
    </div>
  </main>
</template>

<style scoped>

</style>
