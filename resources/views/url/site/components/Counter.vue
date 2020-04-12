<template>
    <div>
        <p>
            <strong class="text-primary">URL Click Counter:</strong>&nbsp;<span>Enter the URL to find out how many clicks it has received so far.</span><br/>
            <span>Example: ly.tvqhub.com/abcxyz <i class="fas fa-long-arrow-alt-right"></i> <code>abcxyz</code></span>
        </p>
        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Enter here the code of shorten URL"
                   aria-label="Enter here the code of shorten URL" aria-describedby="button-submit" maxlength="6"
                   v-model="slug">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-submit" @click.prevent="submit()"
                        :disabled="isDisabled">
                    <strong>Track Clicks</strong>
                </button>
            </div>
        </div>
        <div class="result mt-2">
            <div class="alert alert-info" v-if="success">
                <ul>
                    <li>Short link: <strong>{{ backend.domain }}/{{ data.slug }}</strong></li>
                    <li>Original link: <strong>{{ data.origin_url }}</strong></li>
                    <li>Total clicks: <strong>{{ data.clicks }}</strong></li>
                    <li>Created: <strong>{{ data.created_at }}</strong></li>
                    <li>Last clicked: <strong>{{ data.updated_at }}</strong></li>
                </ul>
            </div>
            <div class="alert alert-warning" v-if="isNotFound">
                This short link code is not existed in system.
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Counter',
        props: ['backend'],
        data() {
            return {
                success: false,
                isLoading: false,
                isNotFound: false,
                slug: '',
                data: null,
            }
        },
        computed: {
            isDisabled() {
                return this.isLoading || this.slug.length < 6;
            },
        },
        methods: {
            submit() {
                this.isLoading = true;
                axios({
                    method: 'POST',
                    url: '/counter',
                    data: {
                        slug: this.slug
                    },
                    errorHandle: false
                }).then(response => {
                    this.isLoading = false;
                    this.isNotFound = false;
                    this.success = response.data.success;
                    this.data = response.data.data;
                }).catch(error => {
                    this.isLoading = false;
                    if (error.response.status === 404) {
                        this.success = false;
                        this.isNotFound = true;
                    }
                });
            }
        }
    }
</script>
