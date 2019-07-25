<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <strong>Hocanızı Puanlamak İster Misiniz?</strong><br>
                <star-rating :round-star-rating="false" :increment="0.1" :inline="true" :star-size="30" @rating-selected="setRating"></star-rating>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click="sendRating">Puanı Ver</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        name: "rate",
        props: ['userId', 'rating', 'raters'],
        data() {
            return {
                givenRating: 0,
            }
        },

        // oldRating: 0,  // The Latest Rating
        // numRaters: 0,  // Number of people voted before
        methods: {
            setRating(rating) {
                this.givenRating = rating;
                console.log(this.givenRating);
            },
            sendRating() {
                // Post the new rating of the teacher
                axios.post('/rate', {
                    id: this.userId,
                    // Have to parse the database value to integer here! Weirdo JS.
                    rating: (this.rating * this.raters + this.givenRating) / (parseInt(this.raters) + 1),
                }).then(function (response) {
                    console.log('Rating Set!');
                }).catch(error => {
                    console.log(error.message);
                });
                this.$emit('close');
            }
        }
    }
</script>

<style>

</style>