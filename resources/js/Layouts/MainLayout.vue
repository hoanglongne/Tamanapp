<template>
    <div class="flex">
        <button @click="toggleSidebar" class="absolute z-20 p-4 md:hidden">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 12L6 6"></path>
            </svg>
        </button>
        
        <div :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full md:translate-x-0 ease-in'" class="fixed font-bold font-anon flex h-screen items-center justify-center md:justify-start pt-52 md:pt-10 flex-col gap-4 z-10 inset-0 bg-[#f9fbff] p-4 md:inset-auto md:w-64 transition-transform duration-200">
            <div class="font-orbi justif-start font-black text-xl md:text-2xl">
              <span class="text-[#e6afff]">
                  TAMANAPP
              </span>
            </div>

            <div class="flex items-center text-lg gap-3 justify-center flex-col">
                <Link href="/">Welcome</Link>
                <Link href="/users">Employee</Link>
                <Link href="/tasks">Task</Link>
                <Link href="/tasks/create">Add Task</Link>
            </div>

            <div class="mt-auto mb-10 text-lg">
                <Link href="/login">Login</Link>
            </div>
        </div>

      <div class="flex-1 p-10 font-mono md:ml-64">
        <slot>
        </slot>
      </div>
    </div>
  </template>

<script setup>
import { computed, ref, onMounted, onBeforeUnmount, watchEffect } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { useToast } from 'vue-toast-notification'

let mql

const toggleSidebar = () => {
  if (mql.matches) {
    return
  }
  isOpen.value = !isOpen.value
}

onMounted(() => {
  mql = window.matchMedia('(min-width: 768px)')
  mql.addListener(toggleSidebar)
})

onBeforeUnmount(() => {
  mql.removeListener(toggleSidebar)
})

const isOpen = ref(false)
const page = usePage()
const flashSuccess = computed(
    () => page.props.flash.success,
)

const toast = useToast()

watchEffect(() => {
  if (flashSuccess.value) {
    toast.success(flashSuccess.value, {
      duration: 5000,
    })
  }
})

</script>

