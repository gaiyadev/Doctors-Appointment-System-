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
    },
    {
        path: '/add_doctor',
        component: require('./views/AddDoctor').default
    },
    {
        path: '/doctor_available',
        component: require('./views/DoctorAvailable').default
    },
    {
        path: '/doctor_calender',
        component: require('./views/DoctorCalender').default
    },
    {
        path: '/complain_list',
        component: require('./views/ComplainList').default
    },
    {
        path: '/list_appointment',
        component: require('./views/ListAppointment').default
    },
    {
        path: '/add_time',
        component: require('./views/AddTime').default
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


