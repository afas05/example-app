<script>
import axios from "axios";
import EditTask from "@/components/EditTask.vue";
import FinishedTask from "@/components/FinishedTask.vue";
import TaskCard from "@/components/TaskCard.vue";

export default {
  name: "TaskList",
  components: {EditTask, FinishedTask, TaskCard},
  props: {
    tasks: JSON,
    newTask: Boolean,
  },
  data() {
    return {
      editing: false,
      editingId: null
    };
  },
  computed: {
    tasksList() {
      return this.tasks;
    }
  },
  methods: {
    edit(task) {
      this.editing = true;
      this.editingId = task.id;
      this.title = task.title;
      this.text = task.text;
    },
    taskUpdated(title, text) {
      for (let taskIndex in this.tasksList) {
        if (this.tasksList[taskIndex].id === this.editingId) {
          this.tasksList[taskIndex].title = title;
          this.tasksList[taskIndex].text = text;
        }
      }

      this.editing = false;
      this.editingId = null;
    },
    markAsFinished(id) {
      for (let taskIndex in this.tasksList) {
        if (this.tasksList[taskIndex].id === id) {
          this.tasksList[taskIndex].is_done = true;
        }
      }
    },
    deleteTask(id) {
      for (let taskIndex in this.tasksList) {
        if (this.tasksList[taskIndex].id === id) {
          this.tasksList[taskIndex].deleted = true;
        }
      }
    },
    addTask(taskData) {
      console.log(taskData);
      for (let taskIndex in this.tasksList) {
        if (this.tasksList[taskIndex].id === 'new') {
          this.tasksList[taskIndex].id = taskData.id;
          this.tasksList[taskIndex].title = taskData.title;
          this.tasksList[taskIndex].text = taskData.text;
        }
      }

      this.editing = false;
      this.editingId = null;
    }
  }
}
</script>

<template>
  <div v-for="task in tasksList" class="card mb-2 mt-2" :class="{'d-none': task.deleted}" style="width: 18rem;">
    <EditTask v-if="editingId === task.id" :task="task" @task-updated="taskUpdated" @task-created="addTask"/>
    <FinishedTask v-else-if="task.is_done" :task="task" @task-deleted="deleteTask"/>
    <div v-else-if="task.deleted" class="d-none"></div>
    <TaskCard v-else :task="task" @edit="edit(task)" @task-finished="markAsFinished" @task-deleted="deleteTask"/>
  </div>
</template>

<style scoped>

</style>
