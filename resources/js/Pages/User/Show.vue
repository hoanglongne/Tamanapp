<template>
  <div class="font-anon mt-2 md:mt-0 max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Role: {{ user.role }}</div>
        <h2 class="block mt-1 font-bold text-2xl leading-8 text-black">{{ user.name }}</h2>
        <p class="mt-2 text-gray-500">{{ user.email }}</p>
      </div>
    </div>
    <div class="p-8">
      <h3 class="font-semibold text-lg mb-2">Tasks</h3>
      <ul>
        <li v-for="(task, index) in user.monitored_tasks" :key="index" class="flex items text-md mt-3">
          <span :class="getStatusClass(task.status)" class="inline-block max-h-6 rounded-full px-3 py-1 text-sm font-semibold mr-3">
          </span>
          <div class="relative">
            <Link :href="route('tasks.show', {task: task.id})" class="hover:text-indigo-500 inline-block">
              <p>{{task.title}}</p>
            </Link>
            <p class="text-sm text-gray-500">Due in {{ formatDeadline(task.deadline) }}</p>
            <div class="absolute left-0 bottom-0 w-0 h-0.5 bg-blue-300 transition-all duration-200 ease-in-out transform scale-x-0 group-hover:scale-x-100"></div>
          </div>
        </li>
      </ul>
  </div>
  </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';
import { formatDistanceToNow, parseISO } from 'date-fns';

defineProps({user: Object});

const formatDeadline = (date) => {
    return formatDistanceToNow(parseISO(date), { addSuffix: true });
};

const getStatusClass = (status) => {
  switch (status) {
    case 'Not Start':
      return 'bg-red-300 text-white';
    case 'Pending':
      return 'bg-yellow-300 text-white';
    case 'In Process':
      return 'bg-blue-300 text-white';
    case 'Done':
      return 'bg-green-300 text-white';
    default:
      return 'bg-gray-300 text-white';
  }
}

</script>

