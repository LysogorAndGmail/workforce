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
                            :folder_id='this.$route.params.folder_id'
                            @refreshList="fetchCompanyDocFolder"
                    >
                    </app-add-doc-folder-modal>
                    <app-update-doc-folder-modal
                            :company_id='this.$route.params.company_id'
                            :folder_id='this.$route.params.folder_id'
                            @refreshList="fetchCompanyDocFolder"
                    >
                    </app-update-doc-folder-modal>
                    <app-add-doc-modal
                            :company_id='this.$route.params.company_id'
                            :folder_id='this.$route.params.folder_id'
                            @refreshList="fetchCompanyDocFolder"
                    >
                    </app-add-doc-modal>
                </div>
                <aside id="breadcrumbs">
                    <nav aria-label="breadcrumb" class="container">
                        <ol class="breadcrumb">
                            <li v-for="(bread, index) in breadcrumbs" class="breadcrumb-item">
                                <a href="javascript:void(0)"
                                   @click="showDocFolder(bread[0])">
                                    {{ bread[1] }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ docfolder.name }}</span>
                            </li>
                        </ol>
                    </nav>
                </aside>
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
    import appMultiselect from 'vue-multiselect';
    import appAddDocFolderModal from './AddDocFolderModal';
    import appUpdateDocFolderModal from './UpdateDocFolderModal';
    import appAddDocModal from './AddDocModal';

    export default {
        data() {
            return {
                docfolder: {},
                company_docs_folders: [],
                company_folders: [],
                folder_form: {},
                update_folder_name: {},
                filter_term: '',
                breadcrumbs: [],
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
            showDocFolder(id) {
                this.$router.push({
                    name: 'company.docs.docfolder.show',
                    params: {folder_id: id}
                });
                this.fetchCompanyDocFolder();
            },
            showBreadcrumb(folder_id) {
                axios.get('/docfolder/' + folder_id + '/breadcrumb').then(res => {
                    this.breadcrumbs = res.data;
                }).catch(error => console.log(error));
            },
            fetchCompanyDocFolder() {
                let docs_folders = [];
                let length = 10;
                axios.get('/docfolder/' + this.$route.params.folder_id + '/show').then(res => {
                    this.docfolder = res.data.docfolder;
                    res.data.folders.filter(el => {
                        el.name = this.stringTruncate(el.name);
                        docs_folders.push(el);
                    });
                    res.data.docs.filter(el => {
                        el.name = this.stringTruncate(el.name);
                        docs_folders.push(el);
                    });
                    this.company_docs_folders = docs_folders;
                }).catch(error => console.log(error));
                this.showBreadcrumb(this.$route.params.folder_id);
            },
            removeCompanyDocFolder(index) {
                if (index == '') {
                    this.fetchCompanyDocFolder();
                } else {
                    this.company_docs_folders.splice(index, 1);
                }
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
            appAddDocFolderModal,
            appUpdateDocFolderModal,
            appAddDocModal
        },
        created() {
            this.fetchCompanyDocFolder();
        }
    }
</script>