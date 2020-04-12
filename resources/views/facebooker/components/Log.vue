<template>
    <b-card
        header="Logs"
        header-bg-variant="light"
        bg-variant="light"
    >
        <b-card-text>
            <ul>
                <li v-for="(item, key) in data" :key="key">
                    <span v-if="item.type === 'like'">
                        <i class="far fa-thumbs-up" :class="'text-' + item.alert"></i>
                        <span>Liked <a :href="'https://fb.com/' + item.post_id" target="_blank">{{ item.post_id }}</a> at {{ item.created_at | moment('MMMM Do YYYY, h:mm:ss a') }}</span>
                    </span>
                    <span v-if="item.type === 'friend'">
                        <i class="fas fa-user-friends" :class="'text-' + item.alert"></i>
                        <span><a :href="'https://fb.com/' + item.post_id" target="_blank">{{ item.content }}</a> unfriended at {{ item.created_at | moment('MMMM Do YYYY, h:mm:ss a')  }}</span>
                    </span>
                </li>
            </ul>
            <b-button variant="outline-dark" size="sm" @click="loadLog" :disabled="isDisabled">Load 10 more...</b-button>
        </b-card-text>
    </b-card>
</template>

<script>
    export default {
        name: "Auto",
        data() {
            return {
                data: [],
                number: 0,
                isDisabled: false
            }
        },
        created() {
            this.loadLog();
        },
        methods: {
            loadLog() {
                axios({
                    method: 'GET',
                    url: '/facebooker/logs?skip=' + this.number
                }).then(response => {
                    let resultData = response.data.data;
                    if (_.isEmpty(resultData)) {
                        this.isDisabled = true;
                        return;
                    }
                    this.data.push(resultData);
                    this.data = this.data.flat(1);
                    this.number += 10;
                });
            }
        }
    }
</script>
