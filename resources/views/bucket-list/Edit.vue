<template>
    <div>
        <b-modal id="modal-edit" title="Edit" @ok="handleOk">
            <b-form-group label="Content">
                <b-form-textarea
                    v-model="content"
                    rows="5"
                ></b-form-textarea>
            </b-form-group>

            <b-form-group label="Description">
                <b-form-textarea
                    v-model="description"
                    rows="5"
                ></b-form-textarea>
            </b-form-group>

            <b-form-group label="Complete Date">
                <b-form-datepicker
                    v-model="complete_date"
                ></b-form-datepicker>
            </b-form-group>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "Edit",
        props: ['row'],
        data() {
            return {
                content: '',
                description: '',
                complete_date: null,
            }
        },
        watch: {
            row() {
                axios({
                    method: 'GET',
                    url: '/bucket-list/' + this.row.item.id + '/edit',
                }).then(response => {
                    let data = response.data.data;
                    this.content = data.content;
                    this.description = data.description;
                    this.complete_date = data.complete_date;
                });
            }
        },
        methods: {
            handleOk() {
                axios({
                    method: 'PUT',
                    url: '/bucket-list/' + this.row.item.id,
                    data: {
                        content: this.content,
                        description: this.description,
                        complete_date: this.complete_date
                    }
                }).then(response => {
                    this.$notify(response.data.message);
                    this.$root.$emit('bv::refresh::table', 'datatable');
                });
            }
        }
    }
</script>
