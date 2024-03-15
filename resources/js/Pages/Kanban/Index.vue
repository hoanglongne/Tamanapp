<template>
  <div class="kanban-board">
    <div v-for="(status, index) in statuses" :key="index" class="kanban-column">
      <h2>{{ status }}</h2>
      <draggable v-model="tasksByStatus[status]" group="tasks" class="kanban">
        <div v-for="task in tasksByStatus[status]" :key="task.id" class="kanban-item">
          {{ task.title }}
        </div>
      </draggable>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import draggable from 'vuedraggable'

defineProps({
  task: Object
})

const statuses = ['Not Start', 'Pending', 'In Process', 'Done'];

const tasksByStatus = computed(() => {
  const tasks = {};
  for (const status of statuses) {
    tasks[status] = task.filter(t => t.status === status);
  }
  return tasks;
});
</script>