<template>
    <div>
        <notifications/>
        <div class="mb-3">
            <b-button v-b-modal.modal-create>Add new</b-button>
            <create></create>
            <edit :row="row"></edit>
        </div>

        <b-table :busy.sync="isBusy" :items="getItems" id="datatable">
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
    import Edit from "./Edit";
    export default {
        name: "App",
        components: {Edit, Create},
        data() {
            return {
                isBusy: false,
                row: null,
            }
        },
        methods: {
            async getItems(ctx) {
                this.isBusy = true;
                try {
                    // const response = await axios.get(`/some/url?page=${ctx.currentPage}&size=${ctx.perPage}`)
                    const response = await axios.get('/bucket-list/0');
                    this.isBusy = false;
                    return response.data.data.data;
                } catch (error) {
                    this.isBusy = false;
                    return [];
                }
            },
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
                            this.$root.$emit('bv::refresh::table', 'datatable');
                        });
                    });
            },
            edit(row) {
                this.$bvModal.show('modal-edit');
                this.row = row;
            }
        }
    }
</script>

<style lang="scss">

</style>
