<template>
    <div>
        <div class="text-center my-5">
            <h1 class="app-title text-primary">Short Link <i class="fas fa-link"></i> by TVQhub</h1>
            <h5><code>ly.tvqhub.com/abcxyz</code></h5>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <router-view :backend="backend"></router-view>

                            <div class="text-center mt-4">
                                <hr width="10%">
                                <strong class="d-block mb-2">
                                    <router-link to="/">Generate Short Link</router-link>
                                    <span class="mx-2">&bull;</span>
                                    <router-link to="/counter">URL Click Counter</router-link>
                                </strong>
                                <p class="small">
                                    <span>This is a free tool to shorten a URL or reduce a link, making it easy to remember.</span><br/>
                                    <span>Powered by <a href="https://tvqhub.com">TVQhub</a> | Inspired by <a
                                        href="https://www.shorturl.at" target="_blank">shorturl.at</a></span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['backend'],
        data() {
            return {
                airlock: null
            }
        },
        mounted() {
            $('[data-toggle="tooltip"]').tooltip();
            this.airlock = this.$props.backend.api + '/airlock';
            this.init();
        },
        methods: {
            async init() {
                await axios(this.airlock + '/csrf', {
                    withCredentials: true
                });
                await axios.post(this.airlock + '/login');
            }
        }
    }
</script>

<style lang="scss">
    // Bootstrap
    @import '~bootstrap/scss/bootstrap';

    #app-url {
        font-family: 'Inconsolata', monospace;

        .app-title {
            font-weight: bold;
            text-shadow: 0 2px 2px #ddd;
            word-wrap: break-word;
        }
    }
</style>
