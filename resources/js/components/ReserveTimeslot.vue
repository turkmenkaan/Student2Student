<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Ders Tarihi Seç</p>
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <slot></slot>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click="$emit('close')">Tamam</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        name: "reserve-timeslot"
    }
</script>

<style scoped>

</style>