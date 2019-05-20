<template>
    <div class="columns">
        <div class="column is-6 is-offset-3">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Tarafını Seç</p>
                </header>
                <div class="card-content">
                    <p>Sitemizde ders vermek mi almak mı istiyorsun?</p>
                    <a @click="setTeacher" class="button is-primary is-medium is-fullwidth">Ders Vermek İstiyorum</a>
                    <a @click="setStudent" class="button is-success is-medium is-fullwidth">Ders Almak İstiyorum</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "role-choser",
        data() {
            return {
                isTeacher: false,
            }
        },
        methods: {
            setTeacher() {
                this.$emit('set-teacher');
            },
            setStudent() {
                this.$emit('set-student');
            }
        },
    }
</script>

<style scoped>
    a {
        margin: 10px 0;
    }
</style>