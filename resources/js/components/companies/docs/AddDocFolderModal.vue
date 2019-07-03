<template>
        <modal name="add_new_doc_folder" height="auto">
            <div class="col-md-12 p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ $t("name") }} *</label>
                            <input type="text"
                                   v-focus
                                   @keyup.enter="addDocFolder(folder_id)"
                                   v-model="folder_form.name"
                                   data-vv-name="name"
                                   data-vv-as="Name"
                                   :class="{'form-control': true, 'is-invalid': errors.has('name') }"
                                   v-validate="'required'">
                            <span class="invalid-feedback" role="alert" v-show="errors.has('name')">
                                <strong>{{ errors.first('name') }}</strong>
                            </span>
                        </div>
                        <div class="col-md-12 text-center pt-3">
                            <button class="btn btn-secondary"
                                    @click="addDocFolder(folder_id)">{{
                                $t("save") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </modal>
</template>

<script>
    export default {
        props: ['company_id', 'folder_id'],
        data() {
            return {
                max_size: 10, // megabytes
                company_docs_folders: [],
                company_folders: [],
                update_folder_name: '',
                update_folder_id: '',
                folder_form: {},
                doc_form: {},
                filter_term: '',
                files: [],
                str_length: 10,
            };
        },
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            addDocFolder(folder_id) {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.folder_form.company_id = this.$route.params.company_id;
                        let folder = '';
                        if(folder_id != '0'){
                            folder = folder_id;
                        }
                        this.folder_form.parent_id = folder;
                        axios.post('/docfolder/store', this.folder_form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.hideDocFolderModal();
                        }).then(res => {
                            this.folder_form = {};
                            this.refreshList();
                        }).catch(error => console.log(error));

                    }
                })
            },
            showDocFolderModal() {
                this.$modal.show('add_new_doc_folder');
            },
            hideDocFolderModal() {
                this.$modal.hide('add_new_doc_folder');
            },
            refreshList() {
                this.$emit('refreshList');
            }
        }
    }
</script>