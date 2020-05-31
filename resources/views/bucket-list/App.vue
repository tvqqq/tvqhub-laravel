<template>
    <div>
        <b-table hover :items="items">
            <template v-slot:cell(last_updated)="row">
                <b>{{ row.item.last_updated }}</b> /
                <a href="#" class="text-primary" @click="edit(row)"><i class="far fa-edit"></i></a> /
                <a href="#" class="text-danger" @click="del(row)"><i class="far fa-trash-alt"></i></a>
            </template>
        </b-table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: []
            }
        },
        created() {
            axios({
                method: 'GET',
                url: '/bucket-list/0'
            }).then(response => {
                this.items = response.data.data.data;
            });
        },
        methods: {
            del(row) {
                this.$bvModal.msgBoxConfirm('Please confirm that you want to delete.', {
                    size: 'sm',
                    okVariant: 'danger',
                    okTitle: 'YES ⚠️',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(() => {
                        console.log(row);
                    });
            },
            edit(row) {
                console.log(row);
            }
        }
    }
</script>

<style lang="scss">

</style>
