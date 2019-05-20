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
        props: ['userId'],
        oldRating: 0,
        data() {
            return {
                givenRating: 0,
                numRaters: 0,
            }
        },
        mounted() {
            var endPoint = '/rating/'.concat(this.userId);

            // Get the latest rating of the teacher
            axios.get(endPoint).then(function (response) {
                console.log(response.data);
                console.log(response.data[1]);

                this.numRaters = response.data[1];
            }).catch(error => {
                console.log(error.message);
            });
        },
        // oldRating: 0,  // The Latest Rating
        // numRaters: 0,  // Number of people voted before
        methods: {
            setRating(rating) {
                this.givenRating = rating;
                console.log(this.givenRating);
            },
            sendRating() {
                console.log(this.oldRating); // WHAT THE HECK IS THE PROBLEM???

                // Post the new rating of the teacher
                axios.post('/rate', {
                    id: this.userId,
                    rating: (this.oldRating * this.numRaters + this.givenRating) / (this.numRaters + 1)
                }).then(function (response) {
                    console.log('Rating Set!');
                }).catch(error => {
                    console.log(error.message);
                });
            }
        }
    }
</script>

<style>

</style>