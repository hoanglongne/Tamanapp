<template>
    <div class="container font-anon max-w-4xl mt-2 md:mt-0 mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                <h3 class="text-2xl md:text-3xl font-semibold text-gray-700">Welcome Back!</h3>
                <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded space-y-6 mt-4" @submit.prevent="login">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" v-model="form.email" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" v-model="form.password" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</div>
                    </div>

                    <div class="mb-6 text-center">
                        <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            type="submit">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
const form = useForm({
    email: null,
    password: null,
})
const login = () => form.post(route('login.store'))
</script>