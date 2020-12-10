<template>
<div>
    <font-awesome-icon :id="'tooltip-target-' + todo.id" class="trash-custom float-right" icon="trash-alt" size="lg" />

    <b-tooltip :target="'tooltip-target-' + todo.id" triggers="click">
        <p>Weet u zeker dat u deze todo wil verwijderen?</p>
        <button class="btn btn-danger" @click="deleteTodo">Ja</button>
        <button class="btn btn-primary" @click="closeTooltip">Nee</button>
    </b-tooltip>
</div>
</template>

<script>
import axios from "axios";
export default {
    props: ['todo'],
    methods: {
        deleteTodo() {
            axios.post(`/api/todo/${this.todo.id}/destroy`)
                .then(response => {
                    console.log(response)
                })
            this.$store.dispatch('deleteTodo', this.todo)
            this.$root.$emit('bv::hide::tooltip');

        },
        closeTooltip() {
            this.$root.$emit('bv::hide::tooltip');
        }
    }
}
</script>

<style>
.trash-custom:hover {
    color: red;
}
</style>
