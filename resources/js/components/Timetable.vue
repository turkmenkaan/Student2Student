<template>
    <div class="columns">
        <div class="column">
            <!--
                Render times within a table with 4 rows and 8 columns
                Each data table represents a time once in 30 min
                The javascript expression inside the curly braces converts 12:00:00 to 12:00
             -->
            <table class="table is-bordered is-hoverable">
                <tr>
                    <td v-for="time in morning" v-bind:class="{ active: !available[time] }" @click="modeChooser(time)">{{ time.split(':').slice(0,2).join(':') }}</td>
                </tr>
                <tr>
                    <td v-for="time in afternoon" v-bind:class="{ active: !available[time] }" @click="modeChooser(time)">{{ time.split(':').slice(0,2).join(':') }}</td>
                </tr>
                <tr>
                    <td v-for="time in evening" v-bind:class="{ active: !available[time] }" @click="modeChooser(time)">{{ time.split(':').slice(0,2).join(':') }}</td>
                </tr>
                <tr>
                    <td v-for="time in night" v-bind:class="{ active: !available[time] }" @click="modeChooser(time)">{{ time.split(':').slice(0,2).join(':') }}</td>
                </tr>
            </table>

            <div class="notification is-success" v-if="showSuccessMessage">
                <button class="delete" @click="showSuccessMessage = false"></button>
                Rezervasyonunuz Yapıldı!<br>
                <strong>Tarih:</strong> {{ selectedDate }}
                <strong>Saat:</strong> {{ courseTime }}
                <strong>Ders:</strong> {{ selectedCourse }}
            </div>

            <div class="notification is-danger" v-if="showErrorMessage">
                <button class="delete" @click="showErrorMessage = false"></button>
                Ders Seçtiğinizden Emin Olun!<br>
            </div>

            <div class="modal" :class="{ 'is-active':showReservePanel }">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Rezervasyon Yap</p>
                        <button class="delete" aria-label="close" @click="showReservePanel = false"></button>
                    </header>
                    <section class="modal-card-body">
                        <strong>Ders:</strong>
                        <div class="select" v-if="isProfileMode">
                            <select name="date" v-model="selectedCourse">
                                <option v-for="course in courses" :value="course">{{ course }}</option>
                            </select>
                        </div>
                        <span v-if="isCoursesMode">{{ course }}</span>
                        <br>
                        <strong>Ders Saati: </strong>{{ courseTime.split(':').slice(0,2).join(':') }}
                        <br>
                        <strong>Dersi Veren: </strong>{{ teacherName }}
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success" @click="reserveTime">Rezervasyonu Yap</button>
                        <button class="button" @click="showReservePanel = false">İptal</button>
                    </footer>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        name: "timetable",
        props: ['mode', 'teacherId', 'teacherName', 'selectedDate', 'student', 'course'],
        data() {
            return {
                options: ['morning', 'afternoon', 'evening', 'night'],
                times: ['08:00:00', '08:30:00', '09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00',
                    '12:00:00', '12:30:00', '13:00:00', '13:30:00', '14:00:00', '14:30:00', '15:00:00', '15:30:00',
                    '16:00:00', '16:30:00', '17:00:00', '17:30:00', '18:00:00', '18:30:00', '19:00:00', '19:30:00',
                    '20:00:00', '20:30:00', '21:00:00', '21:30:00', '22:00:00', '22:30:00', '23:00:00', '23:30:00'],
                available: {'08:00:00': 0, '08:30:00': 0, '09:00:00': 0, '09:30:00': 0, '10:00:00': 0, '10:30:00': 0, '11:00:00': 0, '11:30:00': 0,
                    '12:00:00': 0, '12:30:00': 0, '13:00:00': 0, '13:30:00': 0, '14:00:00': 0, '14:30:00': 0, '15:00:00': 0, '15:30:00': 0,
                    '16:00:00': 0, '16:30:00': 0, '17:00:00': 0, '17:30:00': 0, '18:00:00': 0, '18:30:00': 0, '19:00:00': 0, '19:30:00': 0,
                    '20:00:00': 0, '20:30:00': 0, '21:00:00': 0, '21:30:00': 0, '22:00:00': 0, '22:30:00': 0, '23:00:00': 0, '23:30:00': 0},
                showReservePanel: false,
                showSuccessMessage: false,
                showErrorMessage: false,
                courseTime: '',
                courses: [],
                selectedCourse: '',
                isCoursesMode: false,
                isProfileMode: false,
            }
        },

        computed: {
            morning: function () {
                return this.times.slice(0, 8)
            },
            afternoon: function () {
                return this.times.slice(8,16)
            },
            evening: function () {
                return this.times.slice(16,24)
            },
            night: function () {
                return this.times.slice(24,32)
            },

        },

        watch: {
            selectedDate: function () {
                let self = this;
                axios.get('/times/' + self.teacherId + '/' + self.selectedDate)
                    .then(function(response) {
                    Object.keys(self.available).forEach(function(data) {
                       self.available[data] = 0;
                    });
                    console.log(response.data);
                    response.data.forEach(function(data) {
                        self.available[data.hour] = 1;
                    })
                }).catch(function (error) {
                    console.log(error.response);
                });;
            }
        },

        methods: {
            showPanel: function (time) {
                if (this.available[time]) {
                    this.showReservePanel = true;
                    this.courseTime = time;
                    this.isProfileMode = true;
                }
            },
            showCourseReservationPanel: function (time) {
                if (this.available[time]) {
                    this.showReservePanel = true;
                    this.courseTime = time;
                    this.isCoursesMode = true;
                    this.selectedCourse = this.course;
                }
            },
            modeChooser: function (time) {
                if (this.mode == "profile") {
                    this.showPanel(time);
                } else if (this.mode == "dashboard") {
                    this.availableTime(time);
                } else if (this.mode == "courses") {
                    this.showCourseReservationPanel(time);
                }
            },
            reserveTime: function () {
                if (this.selectedCourse === "") {
                    this.showErrorMessage = true;
                    this.showReservePanel = false;
                    return;
                }
                console.log('Reserved timeslot: ' + this.courseTime);
                axios.post('/reserve', {
                    student: this.student,
                    teacher: this.teacherId,
                    course: this.selectedCourse,
                    hour: this.courseTime,
                    date: this.selectedDate,
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error.response);
                })
                this.showErrorMessage = false;
                this.showReservePanel = false;
                this.showSuccessMessage = true;
                this.available[this.courseTime] = 0;
            },
            availableTime: function (time) {
                if (this.available[time]) {
                    // If the timeslot already exists, delete it
                    axios.delete('/times', {
                        data: {
                            hour: time,
                            date: this.selectedDate,
                            teacher_id: this.teacherId
                        }
                    }).then(function (response) {
                        console.log(response.data);
                    }).catch(function (error) {
                        console.log(error.response);
                    });
                    this.available[time] = 0;
                } else {
                    // If the timeslot does not exist already, create it
                    axios.post('/times', {
                        teacher_id: this.teacherId,
                        date: this.selectedDate,
                        hour: time,
                    }).then (function (response) {
                        console.log(response.data);
                    }).catch(function (error) {
                        console.log(error.response);
                    });
                    this.available[time] = 1;
                }
            },

        },

        mounted() {
            let self = this;
            axios.get('/courseList')
                .then(function (response) {
                    response.data.forEach(function (data) {
                        if (data.teacher_id == self.teacherId) {
                            self.courses.push(data.name);
                        }
                    });
                    console.log(self.courses);
                }).catch(function (error) {
                console.log(error.response);
            });
        }
    }
</script>

<style scoped>
    td {
        background-color: #00B89C;
    }

    td:hover {
        background-color: lime;
    }

    td.active {
        background-color: orangered;
    }

    td.activeHovered {
        background-color: lime;
    }
</style>