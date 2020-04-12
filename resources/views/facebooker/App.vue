<template>
    <b-container>
        <list></list>
        <div class="my-5"></div>
        <log></log>
    </b-container>
</template>

<script>
    import List from "./components/List";
    import Log from "./components/Log";
    export default {
        components: {List, Log},
        props: ['backend'],
    }
</script>
