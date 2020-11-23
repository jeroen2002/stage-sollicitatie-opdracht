<template>
    <div>
        <img src="img/information.svg" width="50px" height="25px" alt="" @click="$bvModal.show(id)" class="float-right">

        <b-modal :id="id" hide-footer>
            <template #modal-title style="text-align: center">
                <h1>{{ todo.title }}</h1>
            </template>
            <div class="d-block text-center">
                <b-img :src="todo.image" fluid alt="Responsive image"></b-img>

                <h3>{{ todo.description }}</h3>
            </div>
            <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Sluiten</b-button>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ['todo', 'id']
}
</script>
