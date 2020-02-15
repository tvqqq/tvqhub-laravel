<template>
    <div>
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Enter the link here"
                   aria-label="Enter the link here" aria-describedby="button-submit">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-submit"><strong>Shorten URL
                </strong></button>
            </div>
        </div>
        <div class="result mt-2 alert alert-info">
            <transition name="fade">
                <div>
                    <span>Here is your short link:</span>
                    <a href="https://ly.tvqhub.com/abcxyz" target="_blank"><strong>https://ly.tvqhub.com/abcxyz</strong></a>
                    <i class="far fa-copy"></i>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        data() {
            return {}
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
