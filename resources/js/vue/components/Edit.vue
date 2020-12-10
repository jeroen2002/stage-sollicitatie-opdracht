<template>
    <div>
        <font-awesome-icon style="margin-left: 10px" class="edit-custom float-right"
                           @click="$bvModal.show('edit-' + todo.id.toString())" icon="edit" size="lg"/>

        <b-modal :id="'edit-' + todo.id.toString()" hide-footer>
            <template #modal-title style="text-align: center">
                <h1>Bewerken van: {{ todo.title }}</h1>
            </template>
            <b-form @submit="saveTodo" enctype="multipart/form-data">
                <b-form-group id="input-group-2" label="Titel*:" label-for="title">
                    <b-form-input
                        id="title"
                        placeholder="Voeg hier de titel toe"
                        v-model="form.title"
                        :value="todo.title"
                    ></b-form-input>
                    <b-form-invalid-feedback
                        id="input-1-live-feedback"
                        v-if="this.errors.title"
                    >{{ this.errors.title }}
                    </b-form-invalid-feedback>

                </b-form-group>


                <b-form-group label="Omschrijving:" label-for="description">
                    <b-form-textarea
                        id="description"
                        v-model="form.description"
                        placeholder="Voeg hier de omschrijving toe"
                        rows="3"
                        max-rows="6"
                    ></b-form-textarea>
                </b-form-group>
                <div id="preview">
                    <b-img class="image-preview" :src="'storage/images/' + form.imagePreview" fluid :alt="form.imagePreview"></b-img>
                    <br/>
                </div>

                <b-form-file
                    accept="image/*"
                    placeholder="Kies een afbeelding of zet het hier neer..."
                    drop-placeholder="Zet de afbeelding hier neer..."
                    v-model="form.image"
                ></b-form-file>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                    v-if="this.errors.image"
                    v-model="this.form.image"
                >{{ this.errors.image }}
                </b-form-invalid-feedback>
                <br/>
                <br/>
                <b-button block variant="success" type="submit" :disabled="this.buttonDisabled">Opslaan</b-button>
            </b-form>

            <b-button class="mt-3" block @click="$bvModal.hide('edit-' + todo.id.toString())">Sluiten</b-button>
        </b-modal>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['todo'],

    data() {
        return {
            buttonDisabled: true,
            form: {
                title: this.todo.title,
                description: '',
                imagePreview: '',
                image: '',
            },
            errors: {
                title: null,
                image: null
            }
        }
    },
    mounted() {
        this.form = {
            title: this.todo.description,
            description: this.todo.description,
            // image: todo.image_name,
            imagePreview: this.todo.image_name
        }

        console.log(console.log(this.form.title))
    },
    methods: {
        saveTodo() {
            if (!this.errors.title && !this.errors.image) {
                try {
                    const formData = new FormData();
                    formData.append('title', this.form.title);
                    formData.append('description', this.form.description);
                    formData.append('image', this.form.image)

                    // axios.post(`/api/${todo.id}/edit`, formData)
                } catch (e) {
                    console.log(e);
                }
            }
        },
    }
}
</script>

<style>
.edit-custom {
    margin-left: 10px;
}

.edit-custom:hover {
    color: blue;
}
</style>
