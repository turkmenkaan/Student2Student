
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import StarRating from 'vue-star-rating'
import 'axios'

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('rate', require('./components/Rate'));
Vue.component('role-choser', require('./components/RoleChoser'));
Vue.component('edit-profile', require('./components/EditProfile'));
Vue.component('comment', require('./components/Comment'));
Vue.component('star-rating', StarRating);
Vue.component('request-lesson', require('./components/RequestLesson'));
Vue.component('reserve-timeslot', require('./components/ReserveTimeslot'));
Vue.component('timetable', require('./components/Timetable'));

const app = new Vue({
    el: '#app',
    data: {
        showRatePanel: false,
        showEditPanel: false,
        showCommentPanel: false,
        showComments: true,
        showTimes: false,
        chosenDay: 'Pazartesi',
        showTeacherForm: false,
        showStudentForm: false,
        showRequestLessonPanel: false,
        showReservationPanel: false,
        selectedDate: '',
        selectedTeacher: {
            id: '',
            name: ''
        },
        selectedCourse: '',
    },
    methods: {
        changeCommentsPanelStatus() {
            this.showComments = !this.showComments;
        },
        changeTimeTableStatus() {
            this.showTimes = !this.showTimes;
        },
        choseDay(day) {
            this.chosenDay = day;
        },
        showCoursePanel(teacherId, teacherName, course) {
            this.showReservationPanel = true;
            this.selectedTeacher.id = teacherId;
            this.selectedTeacher.name = teacherName;
            this.selectedCourse = course;
        }
    },
    computed: {

    }
});
