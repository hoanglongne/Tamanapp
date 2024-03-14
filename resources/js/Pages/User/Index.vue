<template>
    <div>
        <h1 class="text-2xl mt-2 md:mt-0 font-semibold text-gray-700">Find someone? You come to the right place!</h1>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 relative">
            <Link :href="route('users.show', {user: user.id})" v-for="(user, index) in users" :key="index" class="border p-4 rounded-lg group flex justify-between items-center">
                <div>
                    <h2 class="text-md font-bold">{{ user.name }}</h2>
                    <div class="text-sm lg:text-md">
                        <p>{{ user.email }}</p>
                        <p class="mt-3">Tasks: {{ user.monitored_tasks.length }}</p>
                    </div>
                </div>
                <div class=" pr-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <svg width="23" height="40" viewBox="0 0 23 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.75 2L20.75 20L11.75 38" stroke="#454B7E" stroke-width="4" stroke-linecap="round"/>
<path d="M2.75 6.5L11.75 20L2.75 33.5" stroke="#454B7E" stroke-width="4" stroke-linecap="round"/>
</svg>

                </div>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    users: Array,
})
</script>