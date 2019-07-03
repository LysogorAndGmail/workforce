<template>
        <modal name="update_doc_folder" height="auto">
            <div class="col-md-12 p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ $t("name") }} *</label>
                            <input type="text"
                                   v-focus
                                   @keyup.enter="updateDF"
                                   v-model="update_folder_name"
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
                                    @click="updateDF">{{
                                $t("update") }}
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
            showUpdateDocFolderModal() {
                this.$modal.show('update_doc_folder');
            },
            hideUpdateDocFolderModal() {
                this.$modal.hide('update_doc_folder');
            },
            updateFolde(doc_folder_id) {
                axios.get('/docfolder/' + doc_folder_id + '/show').then(res => {
                    this.update_folder_name = res.data.docfolder.name;
                    this.update_folder_id = doc_folder_id;
                }).catch(error => console.log(error));
            },
            updateDF() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.put('/docfolder/' + this.update_folder_id + '/update', {name: this.update_folder_name}).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.hideUpdateDocFolderModal();
                            this.fetchCompanyDocsFolders();
                        }).catch(error => console.log(error));
                    }
                })
            },
            refreshList() {
                this.$emit('refreshList');
            }
        }
    }
</script>