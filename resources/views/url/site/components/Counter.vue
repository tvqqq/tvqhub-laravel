<template>
    <div>
        <p>
            <strong class="text-primary">URL Click Counter:</strong>&nbsp;<span>Enter the URL to find out how many clicks it has received so far.</span><br/>
            <span>Example: ly.tvqhub.com/abcxyz <i class="fas fa-long-arrow-alt-right"></i> <code>abcxyz</code></span>
        </p>
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Enter here the code of shorten URL"
                   aria-label="Enter here the code of shorten URL" aria-describedby="button-submit">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-submit"><strong>Track Clicks
                </strong></button>
            </div>
        </div>
        <div class="result mt-2 alert alert-info">
            <transition name="fade">
                <ul>
                    <li>Short link: <strong>https://ly.tvqhub.com/abcxyz</strong></li>
                    <li>Original link: <strong>https://tvqhub.com</strong></li>
                    <li>Total clicks: <strong>12</strong></li>
                    <li>Created at: <strong>2020-02-01 10:00:00</strong></li>
                    <li>Last clicked: <strong>2020-02-01 12:00:00</strong></li>
                </ul>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Counter',
        data() {
            return {}
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
