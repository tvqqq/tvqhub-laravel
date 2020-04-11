<template>
    <b-card
        border-variant="success"
        header-bg-variant="success"
        header-text-variant="white"
        header-border-variant="success"
    >
        <template v-slot:header>
            <div class="d-flex justify-content-between align-items-center">
                <span>Friends List</span>
                <b-button @click="updateList" size="sm" variant="light" :disabled="isUpdate" v-html="textUpdate"></b-button>
            </div>
        </template>
        <b-input-group>
            <template v-slot:prepend>
                <b-input-group-text><i class="fas fa-search"></i>&nbsp;Search friend</b-input-group-text>
            </template>
            <b-form-input v-model="search"></b-form-input>
        </b-input-group>
        <b-row>
            <b-col cols="3" v-for="(item, key) in data.data" :key="key">
                <div class="d-flex flex-column p-3">
                    <a :href="'https://fb.com/' + item.fbid" target="_blank">
                        <img :src="item.avatar" width="150px"/>
                    </a>
                    <span class="mt-1">
                        {{ item.name }}&nbsp;
                        <span v-if="item.gender === 'male'">
                            <i class="fas fa-mars text-info"></i>
                        </span>
                        <span v-else>
                            <i class="fas fa-venus text-warning"></i>
                        </span>
                    </span>
                </div>
            </b-col>
        </b-row>

        <pagination :data="data" @pagination-change-page="getResults" :show-disabled="true" :limit="1"
                    align="center"></pagination>
    </b-card>
</template>

<script>
    export default {
        name: "List",
        data() {
            return {
                data: {},
                originData: {},
                search: '',
                textUpdate: 'Update',
                isUpdate: false
            }
        },
        created() {
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
                axios({
                    method: 'GET',
                    url: '/facebooker/friends?page=' + page + '&search=' + this.search
                }).then(response => {
                    this.data = response.data.data;
                    if (_.isEmpty(this.search)) {
                        this.originData = this.data;
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            updateList() {
                this.isUpdate = true;
                this.textUpdate = '<i class="fas fa-spinner fa-spin"></i> Loading';
                axios({
                    method: 'GET',
                    url: '/facebooker/friends/update'
                }).then(response => {
                    this.textUpdate = '<i class="fas fa-check"></i> Completed';
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        watch: {
            search() {
                if (this.search) {
                    this.getResults();
                } else {
                    this.data = this.originData;
                }
            }
        }
    }
</script>
