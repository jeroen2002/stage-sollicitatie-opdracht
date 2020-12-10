<template>
  <div>
    <font-awesome-icon
      class="info-custom float-right"
      icon="info-circle"
      size="lg"
      @click="$bvModal.show('show-' + todo.id.toString())"
    />

    <b-modal :id="'show-' + todo.id.toString()" hide-footer>
      <template #modal-title style="text-align: center;display:inline;">
        <input
              :checked="todo.is_done"
              type="checkbox"
              name="todo"
              value="todo"
              disabled
            />
        <label style="position:absolute; padding-left: 15px;">
          {{ todo.title }}
        </label>
        
        
      </template>
      <div class="d-block text-center" v-if="todo.image_name">
        <b-img
          :src="'storage/images/' + todo.image_name"
          fluid
          alt="Image"
        ></b-img>
      </div>
      <h3>{{ todo.description }}</h3>

      <b-button
        class="mt-3"
        block
        @click="$bvModal.hide('show-' + todo.id.toString())"
        >Sluiten</b-button
      >
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["todo"],
};
</script>

<style scoped>
.info-custom {
  margin-left: 10px;
}

.info-custom:hover {
  color: blue;
  cursor: pointer;
}

input[type="checkbox"] {
  position: relative;
  width: 1.5em;
  height: 1.5em;
  color: #363839;
  border: 1px solid #bdc1c6;
  border-radius: 4px;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: 0;
  cursor: pointer;
  -webkit-transition: background 175ms cubic-bezier(0.1, 0.1, 0.25, 1);
  transition: background 175ms cubic-bezier(0.1, 0.1, 0.25, 1);
}
input[type="checkbox"]::before {
  position: absolute;
  content: "";
  display: block;
  top: 4px;
  left: 9px;
  width: 8px;
  height: 14px;
  border-style: solid;
  border-color: #fff;
  border-width: 0 2px 2px 0;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  opacity: 0;
}
input[type="checkbox"]:checked {
  color: #fff;
  border-color: #06842c;
  background: #06842c;
}
input[type="checkbox"]:checked::before {
  opacity: 1;
}
input[type="checkbox"]:checked ~ label::before {
  -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
}
</style>
