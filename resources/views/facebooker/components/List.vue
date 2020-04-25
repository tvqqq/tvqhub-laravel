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
            <b-form-checkbox v-model="auto" button class="border-left ml-3 pl-3" button-variant="danger">
                <i class="fas fa-heart"></i> Show Auto
            </b-form-checkbox>
        </b-input-group>
        <b-row>
            <b-col cols="3" v-for="item in data.data" :key="item.id">
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
                        <b-input-group size="sm" class="w-50">
                            <template v-slot:prepend>
                                <b-input-group-text class="timer-icon"><i class="fas fa-clock"></i></b-input-group-text>
                            </template>
                            <b-form-select v-model="item.timer" :options="timerAvailable" @change="updateAuto(item.id, item.timer)"></b-form-select>
                          </b-input-group>
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
                isUpdate: false,
                selected: null,
                timerAvailable: [],
                auto: false
            }
        },
        created() {
            this.getResults();
            this.getTimerAvaiable();
        },
        methods: {
            getResults(page = 1) {
                axios({
                    method: 'GET',
                    url: '/facebooker/friends?page=' + page + '&search=' + this.search + '&auto=' + this.auto
                }).then(response => {
                    this.data = response.data.data;
                    if (_.isEmpty(this.search) && !this.auto) {
                        this.originData = this.data;
                    }
                });
            },
            updateList() {
                this.isUpdate = true;
                this.textUpdate = '<i class="fas fa-spinner fa-spin"></i> Loading';
                axios({
                    method: 'PATCH',
                    url: '/facebooker/friends/update'
                }).then(response => {
                    let faIcon = response.data.success ? 'check' : 'times';
                    this.textUpdate = '<i class="fas fa-' + faIcon + '"></i> ' + response.data.message;
                });
            },
            getTimerAvaiable() {
                axios({
                    method: 'PATCH',
                    url: '/facebooker/timer'
                }).then(response => {
                    this.timerAvailable = response.data.data;
                    this.timerAvailable = this.timerAvailable.flat(1);
                });
            },
            updateAuto(id, selected) {
                axios({
                    method: 'PATCH',
                    url: '/facebooker/friends/timer',
                    data: {
                        'id': id,
                        'timer': selected
                    }
                }).then(response => {
                    this.getTimerAvaiable();
                });
            },
            fetchData(variable) {
                if (variable) {
                    this.getResults();
                } else {
                    this.data = this.originData;
                }
            }
        },
        watch: {
            search() {
                this.fetchData(this.search);
            },
            auto() {
                this.fetchData(this.auto);
            }
        }
    }
</script>

<style scoped>
    .timer-icon {
        padding: 2px !important;
    }
</style>
