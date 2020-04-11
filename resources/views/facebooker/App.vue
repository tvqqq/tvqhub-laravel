<template>
    <b-container>
        <auto></auto>
        <div class="my-5"></div>
        <list></list>
    </b-container>
</template>

<script>
    import Auto from "./components/Auto";
    import List from "./components/List";
    export default {
        components: {List, Auto},
        props: ['backend'],
    }
</script>

<style lang="scss">

</style>
