<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button class="delete" aria-label="close" @click="$emit('close')"></button>
                <p class="modal-card-title">Profil Bilgilerini Güncelle</p>
            </header>
            <form :action="route" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <section class="modal-card-body">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Okul Bilgileri</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded">
                                    <input type="text" name="school" placeholder="Okul Adı" class="input">
                                </p>
                            </div>
                            <div class="field is-expanded">
                                <div class="control select">
                                    <select name="class">
                                        <option value="" disabled selected>Sınıfınız...</option>
                                        <option value="9">Lise 1</option>
                                        <option value="10">Lise 2</option>
                                        <option value="11">Lise 3</option>
                                        <option value="12">Lise 4</option>
                                        <option value="1">Üniversite 1</option>
                                        <option value="2">Üniversite 2</option>
                                        <option value="3">Üniversite 3</option>
                                        <option value="4">Üniversite 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Ücret</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input type="text" name="cost" placeholder="100 TL" class="input">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Tanıtım Yazısı</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded">
                                    <textarea class="textarea" placeholder="Kendini kısaca tanıtır mısın?" rows="3" name="description"></textarea>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Profil Resmi</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="file has-name">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="profilePic" @change="onFileSelected">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Dosya Seç...
                                            </span>
                                        </span>
                                        <span class="file-name">
                                            {{ fileName }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="field is-grouped is-grouped-right">
                        <p class="control">
                            <input type="submit" class="button is-primary" value="Güncelle">

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
        name: "edit-profile",
        props: ['userId', 'route'],
        data() {
            return {
                selectedImage: null,
                fileName: 'Henüz resim yüklenmedi!',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods: {
            onFileSelected(event) {
                this.selectedImage = event.target.files[0];
                this.fileName = event.target.files[0].name;
            },
        }
    }
</script>

<style scoped>

</style>