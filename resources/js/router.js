import VueRouter from 'vue-router'

const routes = [
    {
        path: '/book',
        //  name: 'Home',
        component: require('./views/BookAppointment').default
    },
    {
        path: '/profile',
        component: require('./views/Profile').default
    },
    {
        path: '/Dashboard',
        component: require('./views/Dashboard').default
    },
    {
        path: '/calender',
        component: require('./views/Calender').default
    },
    {
        path: '/map',
        component: require('./views/Map').default
    },
    {
        path: '/complain',
        component: require('./views/Complain').default
    }
]

// const router = new VueRouter({
//     mode: 'history',
//     //base: process.env.BASE_URL,
//     routes
// })

// export default router

export default new VueRouter({
    mode: 'history',
    //base: process.env.BASE_URL,
    routes
});


