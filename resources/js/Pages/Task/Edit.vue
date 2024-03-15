<template>
    <div class="max-w-4xl mt-2 md:mt-0 mx-auto font-anon bg-white p-6">
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-700 mb-4">Edit Your Task</h1>
        <form @submit.prevent="edit" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" v-model="form.title" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div v-if="form.errors.title" class="mt-2 text-sm text-red-600">
                    {{ form.errors.title }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea v-model="form.description" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                <div v-if="form.errors.description" class="mt-2 text-sm text-red-600">
                    {{ form.errors.description }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select v-model="form.status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Not Start">Not Start</option>
                    <option value="In Process">In Process</option>
                    <option value="Pending">Pending</option>
                    <option value="Done">Done</option>
                </select>
                <div v-if="form.errors.status" class="mt-2 text-sm text-red-600">
                    {{ form.errors.status }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deadline</label>
                <input type="date" v-model="form.deadline" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div v-if="form.errors.deadline" class="mt-2 text-sm text-red-600">
                    {{ form.errors.deadline }}
                </div>
            </div>

            <label for="users" class="text-sm">Assign to:  </label>
            <select class="border border-gray-300 rounded-sm text-sm" id="users" v-model="form.user_id">
                <option v-for="user in users" :key="user.id" :value="user.id">
                    {{ user.name }}
                </option>
            </select>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import {useForm, usePage} from '@inertiajs/vue3';

    const page = usePage();

    const props = defineProps({
        tasks: Object,
        users: Array
    });

    const form = useForm({
        title: props.tasks.title,
        description: props.tasks.description,
        status: props.tasks.status,
        deadline: props.tasks.deadline.split('T')[0], 
        created_by_user_id: props.tasks.created_by_user_id,
        user_id: props.tasks.user_id
    });

    const edit = () => form.put(route('tasks.update', props.tasks.id));
</script>

