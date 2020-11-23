<template>
    <b-container>
        <b-row>
            <b-col>
                <Create/>
            </b-col>
            <b-col>
                <List/>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import Create from "../components/Create";
import List from "../components/List";

export default {
    components: {List, Create},
}
</script>
