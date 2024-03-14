import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from './Layouts/MainLayout.vue'
import { ZiggyVue } from 'ziggy'
import '../css/app.css'
import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-default.css'

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue')

        const page = await pages[`./Pages/${name}.vue`]()
        page.default.layout = page.default.layout || MainLayout

        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueToast, {
                position: 'top-right',
                duration: 15000,
            })
            .mount(el)
    },
})