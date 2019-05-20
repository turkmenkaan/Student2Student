<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
                <p class="modal-card-title">Hocanıza Yorum Yapın</p>
            </header>
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "comment",
        props: ['route'],
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>