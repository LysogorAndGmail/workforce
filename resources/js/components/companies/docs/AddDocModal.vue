<template>
        <modal name="add_new_doc" height="auto">
            <div class="col-md-12 p-4">
                <div class="row">
                    <div class="col-md-12">
                        <dropzone id="foo" ref="el" :options="options"
                                  :destroyDropzone="true"></dropzone>
                        <input type="hidden"
                               :class="{'form-control': true, 'is-invalid': errors.has('file') }"
                               @keyup.enter="addDoc"
                               v-model="dropzone_files"
                               data-vv-name="file"
                               data-vv-as="Files"
                               v-validate="'required'">
                        <span class="invalid-feedback" role="alert" v-show="errors.has('file')">
                                                                        <strong>{{ errors.first('file') }}</strong>
                                                                    </span>
                        <div class="col-md-12 text-center pt-3">
                            <button class="btn btn-secondary"
                                    @click="addDoc">{{
                                $t("upload") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </modal>
</template>

<script>
    import Dropzone from 'nuxt-dropzone';
    import 'nuxt-dropzone/dropzone.css';

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
                dropzone_files: '',
                options: {
                    url: "/doc/upload",
                },
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
            showDocModal() {
                this.$modal.show('add_new_doc');
            },
            hideDocModal() {
                this.$modal.hide('add_new_doc');
            },
            addDoc() {

                if (this.$refs.el.dropzone.files.length > 0) {
                    this.dropzone_files = this.$refs.el.dropzone.files.length;
                } else {
                    this.dropzone_files = '';
                }

                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        let formData = new FormData();
                        for (var i = 0; i < this.$refs.el.dropzone.files.length; i++) {
                            let file = this.$refs.el.dropzone.files[i];
                            formData.append('files[' + i + ']', file);
                        }
                        formData.append('count_files', this.$refs.el.dropzone.files.length);
                        formData.append('name', 'file');
                        formData.append('company_id', this.$route.params.company_id);
                        let folder = '';
                        if (this.$route.params.folder_id) {
                            folder = this.$route.params.folder_id;
                        }
                        formData.append('folder_id', folder);

                        axios.post('/doc/store', formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.hideDocModal();
                        }).then(res => {
                            this.doc_form = {};
                            this.refreshList();
                        }).catch(error => console.log(error));
                    }
                })

            },
            refreshList() {
                this.$emit('refreshList');
            }
        },
        components: {
            Dropzone,
        },
    }
</script>