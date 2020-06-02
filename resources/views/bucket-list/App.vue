<template>
    <div>
        <notifications/>
        <div class="mb-3">
            <b-button v-b-modal.modal-create>Add new</b-button>
            <create :items="items" :fields="fields"></create>
        </div>

        <b-table :items="items" ref="table">
            <template v-slot:cell(last_updated)="row">
                <b>{{ row.item.last_updated }}</b> /
                <a href="#" class="text-primary" @click="edit(row)"><i class="far fa-edit"></i></a> /
                <a href="#" class="text-danger" @click="del(row)"><i class="far fa-trash-alt"></i></a>
            </template>
        </b-table>
    </div>
</template>

<script>
    import Create from "./Create";
    export default {
        name: "App",
        components: {Create},
        data() {
            return {
                fields: ['id', 'content', 'description', 'complete_date', 'last_updated'],
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
                        axios({
                            method: 'DELETE',
                            url: '/bucket-list/' + row.item.id
                        }).then(response => {
                            this.$notify(response.data.message);
                            // if (response.data.data) {
                            //     this.items.splice(row.index, 1);
                            // }
                            this.$refs.table.refresh();
                        });
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
