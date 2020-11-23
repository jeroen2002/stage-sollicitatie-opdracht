<template>
    <div>
        <h1>To do toevoegen</h1>
        <b-form @submit="createTodo">
            <b-form-group id="input-group-2" label="Titel:" label-for="title">
                <b-form-input
                    id="title"
                    v-model="form.title"
                    required
                    placeholder="Voeg hier de titel toe"
                ></b-form-input>
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
            <div id="preview" v-if="form.image.length > 0">
                <b-img :src="form.image" fluid :alt="form.image"></b-img>
                <br/>
            </div>

            <b-form-file
                accept="image/*"
                @change="onImageChange"
                v-model="form.image"
                :state="Boolean(form.image)"
                placeholder="Kies een afbeelding of zet het hier neer..."
                drop-placeholder="Zet de afbeelding hier neer..."
            ></b-form-file>
            <br/>
            <br/>
            <b-button block variant="primary" type="submit">Voeg toe</b-button>
        </b-form>
    </div>
</template>

<script>
export default {

    data() {
        return {
            form: {
                title: null,
                description: null,
                image: "",
            },
            todos: []
        }
    },
    methods: {
        onImageChange(event) {
            const input = event.target;

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.form.image = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },

        createTodo(event) {
            event.preventDefault();
            this.$store.dispatch('addTodo', this.form);
            this.form = {
                title: null,
                description: null,
                image: "",
            };
        }
    }
}
</script>
<style>
#preview {
    display: flex;
    justify-content: center;
    align-items: center;
}

#preview img {
    max-width: 100%;
    max-height: 500px;
}
</style>
