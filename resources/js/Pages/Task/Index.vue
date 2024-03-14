<template>
    <div class="grid grid-cols-1 mt-2 md:mt-0 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div v-for="task in tasks" :key="task.id" class="rounded-lg overflow-hidden border-[1px] border-zinc-300 p-6 bg-white flex flex-col gap-4">
            <div class="font-bold text-lg mb-2">{{ task.title }}</div>
                <p class="text-gray-700 text-sm">{{ task.description.substring(0,200) }}..</p>
                
                <div class="mt-auto">
                    <div class="flex items-center text-gray-500 space-x-2 mb-4">
                        <span class="text-xs md:text-sm">Due in {{ formatDeadline(task.deadline) }}</span>
                        <span class="hidden md:block" >-</span>
                        <span :class="statusClass(task.status)" class="inline-block px-3 py-1 rounded-full text-xs md:text-sm text-center">{{ task.status }}</span>
                    </div>
                    <Link :href="route('tasks.show', {task: task.id})">
                        <button class="border border-emerald-600 text-emerald-600 bg-white font-bold py-2 px-3 text-sm rounded hover:bg-emerald-50">
                            Show
                        </button>
                    </Link>
                    <Link :href="route('tasks.destroy', {task: task.id})" method="DELETE">
                        <button class="border border-rose-400 text-rose-400 bg-white font-bold py-2 px-3 text-sm rounded ml-2 hover:bg-rose-50">
                            Delete
                        </button>
                    </Link>
                    <Link :href="route('tasks.edit', {task: task.id})">
                        <button class="border border-blue-400 text-blue-400 bg-white font-bold py-2 px-3 text-sm rounded ml-2 hover:bg-blue-50">
                            Edit
                        </button>
                    </Link>
                </div>
        </div>
    </div>
</template>

<script setup>
   import { Link } from '@inertiajs/vue3';
   import { formatDistanceToNow, parseISO } from 'date-fns';

    defineProps({tasks: Array});

    const formatDeadline = (date) => {
        return formatDistanceToNow(parseISO(date), { addSuffix: true });
    };

    const statusClass = (status) => {
        switch (status) {
            case 'Not Start':
                return 'bg-gray-200 text-gray-800';
            case 'Pending':
                return 'bg-yellow-200 text-yellow-800';
            case 'In Process':
                return 'bg-red-200 text-red-800';
            case 'Done':
                return 'bg-green-200 text-green-800';
            default:
                return 'bg-gray-200 text-gray-800';
        }
    };
</script>