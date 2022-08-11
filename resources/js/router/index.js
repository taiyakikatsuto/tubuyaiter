import { createWebHistory, createRouter } from 'vue-router'

const Layout = () => import('@/components/layouts/Default.vue')
const Dashboard = () => import('@/components/Dashboard.vue')
const Show = () => import('@/components/Show.vue')
const Create = () => import('@/components/CreateComponent.vue')
const List = () => import('@/components/ListComponent.vue')


const routes = [
    {
        path: "/",
        component: Layout,
        meta: {
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
            {
                name: "list",
                path: '/list',
                component: List,
                meta: {
                    title: `List`
                }
            },
            {
                name: "show",
                path: "/show",
                component: Show,
                meta: {
                    middleware: "guest",
                    title: `Show`
                }
            },
            {
                name: "create",
                path: "/create",
                component: Create,
                meta: {
                    title: `Create`
                }
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
