<template>
    <div>
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Enter the link here"
                   aria-label="Enter the link here" aria-describedby="button-submit" v-model="originUrl">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-submit" @click.prevent="submit()">
                    <strong>Shorten URL</strong>
                </button>
            </div>
        </div>
        <transition name="fade">
            <div class="result mt-2">
                <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                <div class="alert alert-info form-inline" v-show="success">
                    <span>Here is your short link:</span>
                    <input type="text" class="form-control w-50 form-control-sm ml-1" id="short-url" :disabled="true" :value="shortUrl">
                    <button class="btn btn-sm btn-outline-secondary mx-2" data-toggle="tooltip" data-placement="bottom" title="Copy link" @click="copy()"><i class="far fa-copy"></i></button>
                    <button class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Open link" @click="open()"><i class="fas fa-external-link-alt"></i></button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        data() {
            return {
                validationErrors: null,
                success: false,
                originUrl: '',
                shortUrl: '',
            }
        },
        methods: {
            submit() {
                axios({
                    method: 'POST',
                    url: '/',
                    data: {
                        origin_url: this.originUrl
                    }
                }).then(response => {
                    this.success = response.data.success;
                    this.validationErrors = null;
                    this.shortUrl = 'https://ly.tvqhub.com/' + response.data.data.slug; //TODO: pass param url from backend
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.success = false;
                        this.validationErrors = error.response.data.errors;
                    }
                });
            },
            copy() {
                const elemShortUrl = $('#short-url');
                elemShortUrl.prop('disabled', false);
                elemShortUrl.select();
                document.execCommand('copy');
                elemShortUrl.prop('disabled', true);
            },
            open() {
                window.open(this.shortUrl, '_blank');
            }
        }
    }
</script>
