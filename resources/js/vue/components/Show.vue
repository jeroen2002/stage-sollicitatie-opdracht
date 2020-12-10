<template>
    <div>
        <font-awesome-icon class="info-custom float-right" icon="info-circle" size="lg"
                           @click="$bvModal.show('show-' + todo.id.toString())"/>

        <b-modal :id="'show-' + todo.id.toString()" hide-footer>
            <template #modal-title style="text-align: center">
                <h1>{{ todo.title }}</h1>
            </template>
            <div class="d-block text-center" v-if="todo.image_name">
                <b-img :src="'storage/images/' + todo.image_name" fluid alt="Responsive image"></b-img>

            </div>
            <h3>{{ todo.description }}</h3>

            <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Sluiten</b-button>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ['todo'],
}
</script>

<style>
.info-custom {
    margin-left: 10px;
}

.info-custom:hover {
    color: blue;
}
</style>
