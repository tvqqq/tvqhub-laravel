<template>
    <b-container>
        <auto></auto>
        <div class="my-5"></div>
        <list></list>
        <div class="my-5"></div>
        <log></log>
    </b-container>
</template>

<script>
    import Auto from "./components/Auto";
    import List from "./components/List";
    import Log from "./components/Log";
    export default {
        components: {List, Auto, Log},
        props: ['backend'],
    }
</script>

<style lang="scss">

</style>
