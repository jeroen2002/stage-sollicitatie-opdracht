<template>
  <div>
    <font-awesome-icon
      :id="'tooltip-target-' + todo.id"
      class="trash-custom float-right"
      icon="trash-alt"
      size="lg"
    />

    <b-tooltip :target="'tooltip-target-' + todo.id" triggers="click">
      <div class="tooltip-content">
        <p>Weet u zeker dat u deze todo wil verwijderen?</p>
        <button class="btn btn-danger" @click="deleteTodo">Ja</button>
        <button class="btn btn-primary" @click="closeTooltip">Nee</button>
      </div>
    </b-tooltip>
  </div>
</template>

<script>
import axios from "axios";
import Noty from "noty";

export default {
  props: ["todo"],
  methods: {
    deleteTodo() {
      axios.post(`/api/todo/${this.todo.id}/destroy`).then((response) => {
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

          this.$store.dispatch("deleteTodo", this.todo);
        }
      });
      this.$root.$emit("bv::hide::tooltip");
    },
    closeTooltip() {
      this.$root.$emit("bv::hide::tooltip");
    },
  },
};
</script>

<style>
.tooltip-content {
  padding: 10px;
}
.trash-custom:hover {
  color: red;
  cursor: pointer;
}
</style>
