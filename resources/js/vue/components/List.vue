<template>
  <div>
    <h1>To do's</h1>
    <p v-if="!todos.length > 0" class="text-center">Er zijn nog geen to do's.</p>
    <b-list-group>
      <b-list-group-item v-for="(value, index) in todos" :key="index">
        <b-row>
          <b-col>
            <input
              @click="toggleTodoStatus(value)"
              :checked="value.is_done"
              type="checkbox"
              :id="`todo-${value.id}`"
              name="todo"
              value="todo"
              style="margin-right: 15px;"
            />
            <label
              :for="`todo-${value.id}`"
              :data-content="value.title" 
              class="todo"
              >{{ value.title }}</label
            >
          </b-col>
          <b-col style="top: 5px">
            <Show :todo="value" />
            <Delete :todo="value" />
          </b-col>
        </b-row>
      </b-list-group-item>
    </b-list-group>
  </div>
</template>
<style scoped>
input[type="checkbox"] {
  top: 5px;
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
  top: 2px;
  left: 7px;
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

label::before {
  position: absolute;
  content: attr(data-content);
  color: #9c9e9f;
  -webkit-clip-path: polygon(0 0, 0 0, 0% 100%, 0 100%);
  clip-path: polygon(0 0, 0 0, 0% 100%, 0 100%);
  text-decoration: line-through;
  text-decoration-thickness: 3px;
  -webkit-text-decoration-color: #363839;
  text-decoration-color: #363839;
  -webkit-transition: -webkit-clip-path 200ms
    cubic-bezier(0.25, 0.46, 0.45, 0.94);
  transition: -webkit-clip-path 200ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
  transition: clip-path 200ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
  transition: clip-path 200ms cubic-bezier(0.25, 0.46, 0.45, 0.94),
    -webkit-clip-path 200ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
</style>
<script>
import Delete from "./Delete";
import Show from "./Show";
import axios from "axios";

export default {
  components: { Show, Delete },
  mounted() {
    axios.get("/api/todos").then((res) => {
      if (res.data.data) {
        this.$store.dispatch("setTodos", res.data.data);
      }
    });
  },
  computed: {
    todos() {
      return this.$store.state.todos;
    },
  },
  methods: {
    toggleTodoStatus(todo) {
      axios
        .post(`/api/todo/${todo.id}/toggle`)
        .then((response) => {
          this.$store.dispatch("toggleTodoStatus", todo);
        })
        .catch((error) => {
          new Noty({
            type: "error",
            theme: "mint",
            layout: "topRight",
            text: response.data.message,
            timeout: 1000,
          }).show();
        });
    },
  },
};
</script>
