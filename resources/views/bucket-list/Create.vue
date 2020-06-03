<template>
    <div>
        <b-modal id="modal-create" title="Add New" @ok="handleOk">
            <b-form-group label="Content">
                <b-form-textarea
                    v-model="content"
                    rows="5"
                ></b-form-textarea>
            </b-form-group>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "Create",
        data() {
            return {
                content: '',
            }
        },
        methods: {
            handleOk() {
                axios({
                    method: 'POST',
                    url: '/bucket-list',
                    data: {
                        content: this.content
                    }
                }).then(response => {
                    this.$notify(response.data.message);
                    this.$root.$emit('bv::refresh::table', 'datatable');
                });
            }
        }
    }
</script>
