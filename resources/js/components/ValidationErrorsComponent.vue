<template>
    <div v-if="validationErrors">
        <ul class="alert alert-danger">
            <li v-for="(value, key, index) in validationErrors" class="ml-2">{{ value }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        props: ['errors'],
        computed: {
            validationErrors() {
                let errors = Object.values(this.errors);
                errors = errors.flat();
                return errors;
            }
        }
    }
</script>
