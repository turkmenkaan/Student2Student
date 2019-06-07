<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body" style="text-align: center">
               <h3>Dersi Onaylamak İstiyor Musunuz?</h3>
                <div class="columns">
                    <div class="column is-10 is-offset-1">
                        <table class="table is-bordered is-hoverable">
                            <tr>
                                <td><b>Ders Adı</b></td>
                                <td>{{ course }}</td>
                            </tr>
                            <tr>
                                <td><b>Öğrenci</b></td>
                                <td>{{ studentName }}</td>
                            </tr>
                            <tr>
                                <td><b>Ders Tarihi</b></td>
                                <td>{{ date }}</td>
                            </tr>
                            <tr>
                                <td><b>Ders Saati</b></td>
                                <td>{{ hour }}</td>
                            </tr>

                        </table>
                    </div>
                </div>

            </section>
            <footer class="modal-card-foot buttons is-centered" style="text-align: center">
                <button class="button is-success is-large" @click="approve()">Onayla</button>
                <button class="button is-danger is-large" @click="deny()">Reddet</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        name: "approval-panel",
        props: ['studentId', 'studentName', 'course', 'date', 'hour', 'teacher'],
        methods: {
            approve: function () {
                axios.post('/approveReservation', {
                    'teacher_id': this.teacher,
                    'date': this.date,
                    'hour': this.hour,
                    'studentId': this.studentId,
                    'studentName': this.studentName,
                    'course': this.course,
                }).then(function (response) {
                    window.location.href = '/dashboard';
                }).catch(function (error) {
                    console.log(error.response);
                })
            },
            deny: function () {
                axios.post('/denyReservation', {
                    'teacher_id': this.teacher,
                    'date': this.date,
                    'hour': this.hour,
                    'student_id': this.studentId,
                    'studentName': this.studentName
                }).then(function (response) {
                    //window.location.href = '/dashboard';
                    console.log(response.data);
                }).catch(function (error) {
                    console.log(error.response);
                })
            }
        }
    }
</script>

<style scoped>

</style>