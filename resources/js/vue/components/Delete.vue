<template>
    <img style="fill:red;" src="img/delete.svg" width="50px" height="25px" alt="" class="float-right"
         @click="deleteTodo">
</template>

<script>
export default {
    props: ['todo'],
    methods: {
        deleteTodo() {
            this.$store.dispatch('deleteTodo', this.todo)
        }
    }
}
</script>
