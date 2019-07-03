<template>
    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div v-if="!docfolder.size" class="doc_folder">
            <div class="folder-grid-item d-flex justify-content-center align-items-center"
                 @click="showDocFolder(docfolder.id)"
                 @contextmenu.prevent="$refs.index.open">
                <div class="folder-grid-item-inner">
                    <div class="d-flex justify-content-center align-items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M0 2h8l3 3h10v4h3l-4 13h-20v-20zm22.646 8h-17.907l-3.385 11h17.907l3.385-11zm-2.646-1v-3h-9.414l-3-3h-6.586v15.75l3-9.75h16z"></path>
                        </svg>
                    </div>
                    <div v-if="!docfolder.size" class="doc-folder doc-title">
                        <a href="javascript:void(0)">
                            {{ docfolder.name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="folder-grid-item d-flex justify-content-center align-items-center"
                 @contextmenu.prevent="$refs.index.open">
                <div class="folder-grid-item-inner">
                    <div class="d-flex justify-content-center align-items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M22 24h-20v-24h14l6 6v18zm-7-23h-12v22h18v-16h-6v-6zm3 15v1h-12v-1h12zm0-3v1h-12v-1h12zm0-3v1h-12v-1h12zm-2-4h4.586l-4.586-4.586v4.586z"></path>
                        </svg>
                    </div>
                    <div class="doc doc-title">
                        <a href="javascript:void(0)">{{ docfolder.name }}</a>
                    </div>
                </div>
            </div>
        </div>

        <vue-context ref="index">
            <ul>
                <div v-if="!docfolder.size" class="doc-folder">
                    <li v-if="permissions.includes('doc_folder_update')" @click="updateDocFolder(docfolder.id,index)"
                        class="vue-simple-context-menu__item">
                        {{ $t('update') }}
                    </li>
                    <li v-if="permissions.includes('doc_folder_destroy')" @click="destroyDocFolder(docfolder.id,index)"
                        class="vue-simple-context-menu__item">
                        {{ $t('delete') }}
                    </li>
                </div>

                <div v-else class="doc">
                    <li v-if="permissions.includes('doc_read')"
                        class="vue-simple-context-menu__item">
                        <a href="javascript:void(0)" @click="downloadDoc(docfolder.id)">{{ $t('download') }}</a>
                    </li>
                    <li v-if="permissions.includes('doc_destroy')" @click="destroyDoc(docfolder.id,index)"
                        class="vue-simple-context-menu__item">
                        {{ $t('delete') }}
                    </li>
                </div>
            </ul>
        </vue-context>

    </div>
</template>

<script>

    import {VueContext} from 'vue-context';

    export default {
        props: ['docfolder', 'index'],
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            downloadDoc(id) {
                window.location.href = '/doc/' + id + '/download';
            },
            showDocFolder(id) {
                this.$router.push({
                    name: 'company.docs.docfolder.show',
                    params: {folder_id: id}
                });
                this.$emit('removeCompanyDocFolder', '');
            },
            destroyDocFolder(id, menu_id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/docfolder/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompanyDocFolder', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            },
            destroyDoc(id, menu_id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/doc/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompanyDocFolder', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            },
            updateDocFolder(doc_folder_id, menu_id) {
                this.$emit('updateDocFolder', doc_folder_id);
            }
        },
        components: {
            VueContext
        },
    }
</script>
<style>
    .vue-simple-context-menu {
        top: 15px;
        margin: 0;
        padding: 0;
        display: none;
        list-style: none;
        position: absolute;
        z-index: 1000000;
        background-color: #ECF0F1;
        border-bottom-width: 0px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
        box-shadow: 0 3px 6px 0 rgba(51, 51, 51, 0.2);
        border-radius: 4px;
    }

    .vue-simple-context-menu.active {
        display: block !important;
    }

    .vue-simple-context-menu__item {
        display: flex;
        color: #333;
        cursor: pointer;
        padding: 5px 15px;
        align-items: center;
    }

    .vue-simple-context-menu__item:hover {
        background-color: #41ab79 !important;
        color: #fff;
    }

    .vue-simple-context-menu li:first-of-type {
        margin-top: 4px;
    }

    .vue-simple-context-menu li:last-of-type {
        margin-bottom: 4px;
    }

    .doc_folder {
        cursor: pointer;
    }

    .vue-simple-context-menu__item:hover a {
        color: #fff;
    }

    .vue-simple-context-menu__item a {
        color: #000;
    }

    .vue-simple-context-menu__item a:hover {
        text-decoration: none !important;
    }

    .v-context {
        width: 130px !important;
    }
    .doc-title a {
        font-size: 1rem;
    }
</style>