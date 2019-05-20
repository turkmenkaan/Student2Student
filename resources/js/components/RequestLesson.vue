<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
                <p class="modal-card-title">Ders Talep Formu</p>
            </header>
            <form :action="target" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <section class="modal-card-body">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Dersin Adı</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded">
                                    <input type="text" name="lesson_name" placeholder="MEB 12. Sınıf Matematik | IB Math HL | AP Calculus AB" class="input">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Ders Açıklaması</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded">
                                    <textarea class="textarea" placeholder="Hocalarımızın dersi ve içeriği daha iyi anlayabilmeleri için biraz açıklar mısınız?" rows="3" name="description"></textarea>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="field is-grouped is-grouped-right">
                        <p class="control">
                            <input type="submit" class="button is-primary" value="Talep Et" @click="onSubmit">

                        </p>
                        <p class="control">
                            <a class="button is-light" @click="$emit('close')">
                                İptal
                            </a>
                        </p>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "request-lesson",
        props: ['target'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods: {
            onSubmit() {
                console.log("Submitted!");
            }
        }
    }
</script>

<style scoped>
 .modal-card-head p {
     text-align: center;
 }
</style>