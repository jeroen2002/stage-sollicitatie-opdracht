<template>
    <div>
        <h1>To do's</h1>
        <b-list-group>
            <b-list-group-item v-for="(value, index) in todos" :key="index">
                <span :class="{completed: value.completed}" @click="toggleTodoStatus(value)">{{ value.title }}</span>
                <Show :todo="value" :id="index.toString()"/>
                <Delete :todo="value" :id="index.toString()"/>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>
<style scoped>
.completed {
    text-decoration: line-through;
}
</style>
<script>
import Delete from "./Delete";
import Show from "./Show";

export default {
    components: {Show, Delete},
    computed: {
        todos() {
            return this.$store.state.todos;
        }
    },
    methods: {
        toggleTodoStatus(todo) {
            this.$store.dispatch('toggleTodoStatus', todo);
        }
    }
}
</script>
