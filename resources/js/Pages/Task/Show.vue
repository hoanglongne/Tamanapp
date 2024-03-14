<template>
    <div class="max-w-2xl mt-2 md:mt-0 mx-auto bg-white p-6 ">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4">{{ task.title }}</h1>

        <div class="space-y-8 mt-10">
            <div>
                <h4 class="text-lg font-semibold text-gray-600">Description</h4>
                <p class="text-gray-500 mt-2">{{ task.description }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-600">Status</h4>
                <span :class="statusClass(task.status)" class="mt-2 inline-block px-3 py-1 rounded-full text-sm">{{ task.status }}</span>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-600">Deadline</h4>
                <p class="text-gray-500 mt-2">Due in {{ formatDeadline(task.deadline) }}</p>
            </div>

            <div>
                <span class="text-lg font-semibold text-gray-600">Created by user: </span>
                <span class="text-gray-500 mt-2"> {{ task.user.name }} </span>
            </div>
        </div>

        <div class="mt-6 space-x-4">
            <button class="border border-rose-400 text-rose-400 bg-white font-bold py-2 px-4 rounded hover:bg-rose-50"><Link :href="`/tasks/${task.id}`" method="DELETE">Delete</Link></button>
            <button class="border border-blue-400 text-blue-400 bg-white font-bold py-2 px-4 rounded ml-2 hover:bg-blue-50"><Link :href="`/tasks/${task.id}/edit`">Edit</Link></button>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { formatDistanceToNow, parseISO } from 'date-fns';

    defineProps({task: Object});

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