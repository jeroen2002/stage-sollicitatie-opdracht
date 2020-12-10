<template>
  <div>
    <h1>To do toevoegen</h1>
    <b-form @submit="createTodo" enctype="multipart/form-data">
      <b-form-group id="input-group-2" label="Titel*:" label-for="title">
        <b-form-input
          id="title"
          @blur="onTitleInputBlur"
          v-model="form.title"
          placeholder="Voeg hier de titel toe"
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
          @blur="onTextAreaBlur"
        ></b-form-textarea>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
          v-if="this.errors.description"
          >{{ this.errors.description }}
        </b-form-invalid-feedback>
      </b-form-group>
      <div id="preview" v-if="form.imagePreview">
        <b-img
          class="image-preview"
          :src="form.imagePreview"
          fluid
          :alt="form.imagePreview"
        ></b-img>
        <br />
      </div>

      <b-form-file
        accept="image/*"
        placeholder="Kies een afbeelding of zet het hier neer..."
        drop-placeholder="Zet de afbeelding hier neer..."
        @change="onImageChange"
      ></b-form-file>
      <b-form-invalid-feedback
        id="input-1-live-feedback"
        v-if="this.errors.image"
        >{{ this.errors.image }}
      </b-form-invalid-feedback>
      <br />
      <br />
      <b-button
        block
        variant="primary"
        type="submit"
        :disabled="this.buttonDisabled"
        >Voeg toe</b-button
      >
    </b-form>
  </div>
</template>

<script>
import axios from "axios";
import Noty from "noty";

export default {
  computed: {
    buttonDisabled() {
      return (
        !this.form.title ||
        this.errors.image ||
        this.errors.title ||
        this.form.title.length >= 255 ||
        this.form.description.length >= 255
      );
    },
  },
  data() {
    return {
      form: {
        title: "",
        description: "",
        imagePreview: "",
        image: "",
      },
      errors: {
        title: null,
        image: null,
        description: null,
      },
    };
  },
  methods: {
    onImageChange(event) {
      if (!event.target.files[0]) {
        return;
      }

      const fileType = event.target.files[0].type;
      const validImageTypes = ["image/gif", "image/jpeg", "image/png"];

      if (validImageTypes.includes(fileType)) {
        this.errors.image = null;
        const file = event.target.files[0];
        this.form.image = file;
        this.form.imagePreview = URL.createObjectURL(file);
      } else {
        this.errors.image = "De afbeelding moet een GIF, JPEG, of PNG zijn.";
      }
    },
    onTitleInputBlur(event) {
      if (!event.target.value) {
        this.errors.title = "Het titelveld is verplicht!";
      } else if (event.target.value.length >= 255) {
        this.errors.title = "De inhoud mag niet langer zijn dan 255 karakters.";
      } else {
        this.errors.title = null;
      }
    },
    onTextAreaBlur(event) {
      if (event.target.value.length >= 255) {
        this.errors.description =
          "De inhoud mag niet langer zijn dan 255 karakters.";
      } else {
        this.errors.description = null;
      }
    },
    createTodo(event) {
      event.preventDefault();
      if (!this.errors.title && !this.errors.image) {
        const formData = new FormData();
        formData.append("title", this.form.title);
        formData.append("description", this.form.description);
        formData.append("image", this.form.image);

        axios
          .post("/api/todo", formData)
          .then((response) => {
            if (!response.data.success) {
              new Noty({
                type: "error",
                theme: "mint",
                layout: "topRight",
                text: response.data.message,
                timeout: 1000,
              }).show();
            } else {
              new Noty({
                type: "success",
                theme: "mint",
                layout: "topRight",
                text: response.data.message,
                timeout: 1000,
              }).show();

              this.$store.dispatch("addTodo", response.data.data);
            }
          })
          .catch((error) => {
            new Noty({
              type: "error",
              theme: "mint",
              layout: "topRight",
              text: "Er is een fout opgetreden.",
              timeout: 1000,
            }).show();
          });

        this.form = {
          title: "",
          description: "",
          image: "",
          imagePreview: "",
        };
      }
    },
  },
};
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

.invalid-feedback {
  display: block;
}
</style>
