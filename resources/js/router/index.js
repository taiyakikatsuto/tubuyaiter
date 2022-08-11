import { createWebHistory, createRouter } from 'vue-router'
// import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
/* Authenticated Component */

const Show = () => import('@/components/Show.vue')
const Create = () => import('@/components/CreateComponent.vue')
const List = () => import('@/components/ListComponent.vue')


const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            title: `Register`
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
    {
        name: "list",
        path: "/list",
        component: List,
        meta: {
            title: `List`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

// router.beforeEach((to, from, next) => {
//     document.title = to.meta.title
//     if (to.meta.middleware == "guest") {
//         // if (store.state.auth.authenticated) {
//         //     next({ name: "dashboard" })
//         // }
//         next()
//     } else {
//         // if (store.state.auth.authenticated) {
//         //     next()
//         // } else {
//             next({ name: "login" })
//         // }
//     }
// })

export default router
