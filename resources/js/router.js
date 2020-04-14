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
    },
    {
        path: '/user_change_password',
        component: require('./views/UserChangePassword').default
    },
    {
        path: '/user_update_profile',
        component: require('./views/UserProfileUpdate').default
    },
    {
        path: '/admin_update_profile',
        component: require('./views/AdminProfileUpdate').default
    },
    {
        path: '/admin_change_password',
        component: require('./views/AdminChangePassword').default
    },
    {
        path: '/admin_dashboard',
        component: require('./views/AdminDashboard').default
    },
    {
        path: '*',
        component: require('./views/Dashboard').default
    },
]




export default new VueRouter({
    mode: 'history',
    routes
});


