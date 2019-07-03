<template>
    <div class="tab-content responsive">
        <div class="tab-pane show active">
            <div class="responsive">
                <div class="row mt-2 mb-2">
                    <div class="col-md-7">
                        <input type="text" v-model="filter_term" class="form-control"
                               :placeholder="$t('filter_by_name')">
                    </div>
                    <div class="col-md-5" v-if="permissions.includes('doc_folder_create')">
                        <div class="float-right">
                            <button class="btn btn-success btn-small" @click="showDocFolderModal()">
                                {{ $t('add_new_doc_folder') }}
                            </button>
                            <button class="btn btn-secondary btn-small" @click="showDocModal()">
                                {{ $t('add_new_doc') }}
                            </button>
                        </div>
                    </div>
                    <app-add-doc-folder-modal
                            :company_id='this.$route.params.company_id'
                            :folder_id='0'
                            @refreshList="fetchCompanyDocsFolders">
                    </app-add-doc-folder-modal>
                    <app-update-doc-folder-modal
                            :company_id='this.$route.params.company_id'
                            :folder_id='0'
                            @refreshList="fetchCompanyDocsFolders"
                    >
                    </app-update-doc-folder-modal>
                    <app-add-doc-modal
                            :company_id='this.$route.params.company_id'
                            :folder_id='0'
                            @refreshList="fetchCompanyDocsFolders"
                    >
                    </app-add-doc-modal>
                </div>
            </div>
            <div class="element-item">
                <div class="row folder-grid">
                    <app-company-doc-folder v-for="(docfolder, index) in filteredCompanyDocFolders"
                                            :index="index"
                                            :docfolder="docfolder"
                                            :key="index"
                                            @removeCompanyDocFolder="removeCompanyDocFolder"
                    ></app-company-doc-folder>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import appCompanyDocFolder from './TableRow';
    import appAddDocFolderModal from './AddDocFolderModal';
    import appUpdateDocFolderModal from './UpdateDocFolderModal';
    import appAddDocModal from './AddDocModal';
    import appMultiselect from 'vue-multiselect';
    import {VueContext} from 'vue-context';

    export default {
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
                str_length: 10
            };
        },
        computed: {
            filteredCompanyDocFolders() {
                return this.company_docs_folders.filter(el => {
                    if (!el.name) {
                        return false;
                    }
                    return (el.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            },
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            fetchCompanyDocsFolders() {
                let docs_folders = [];
                axios.get('/docfolders/' + this.$route.params.company_id).then(res => {
                    this.company_folders = res.data;
                    res.data.filter(el => {
                        if (el.parent_id == null) {
                            el.name = this.stringTruncate(el.name);
                            docs_folders.push(el);
                        }
                    });
                }).catch(error => console.log(error));
                axios.get('/docs/' + this.$route.params.company_id + '/company').then(res => {
                    res.data.filter(el => {
                        if (el.folder_id == null) {
                            el.name = this.stringTruncate(el.name);
                            docs_folders.push(el);
                        }
                    });
                }).catch(error => console.log(error));
                this.company_docs_folders = docs_folders;
            },
            removeCompanyDocFolder(index) {
                this.company_docs_folders.splice(index, 1);
            },
            stringTruncate(str) {
                let dots = str.length > this.str_length ? '...' : '';
                return str.substring(0, this.str_length) + dots;
            },
            showDocFolderModal() {
                this.$modal.show('add_new_doc_folder');
            },
            showDocModal() {
                this.$modal.show('add_new_doc');
            }
        },
        components: {
            appCompanyDocFolder,
            appMultiselect,
            VueContext,
            appAddDocFolderModal,
            appUpdateDocFolderModal,
            appAddDocModal
        },
        created() {
            this.fetchCompanyDocsFolders();
        }
    }
</script>
<style>
    .dropzone {
        min-height: 200px !important;
    }
</style>