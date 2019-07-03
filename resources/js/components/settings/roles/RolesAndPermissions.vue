<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control"
                           :placeholder="$t('filter_by_permission')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link :to="{name: 'settings.role.create'}" class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_role") }}
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ $t("permissions") }}\{{ $t("roles") }}</th>
                        <th v-for="(role, i) in roles">
                            <div class="btn-group"
                                 v-if="permissions.includes('role_update') || permissions.includes('role_destroy')">
                                <button class="dropdown-toggle color-white" type="button" :id="'role_'+role.id"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ role.display_name }}
                                    <i class="fas fa-edit ml-2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right color-white"
                                     :aria-labelledby="'role_'+role.id">
                                    <router-link :to="{name:'settings.role.edit', params:{role_id:role.id}}"
                                                 class="dropdown-item" tag="a"
                                                 v-if="permissions.includes('role_update')">
                                        {{ $t("edit") }}
                                    </router-link>
                                    <a href="javascript:void(0)" class="dropdown-item" @click="destroy(role.id, i)"
                                       v-if="permissions.includes('role_destroy')">
                                        {{ $t("delete") }}
                                    </a>
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <app-permissions v-for="(permission, index) in filteredPermissions"
                                    :index="index"
                                    :permission="permission"
                                    :roles="roles"
                                    :key="permission.id"></app-permissions>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import appPermissions from './Permissions';

    export default {
        data() {
            return {
                filter_term: '',
                roles: [],
                all_permissions: [],
            };
        },
        computed: {
            filteredPermissions() {
                return this.all_permissions.filter(el => {
                    if (!el.display_name) {
                        return false;
                    }
                    return (el.display_name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            },
            permissions() {
                return this.$store.getters.getUserPermissions;
            },
        },
        methods: {
            fetchRoles() {
                axios.get('/roles').then(res => {
                    this.roles = res.data;
                }).catch(error => console.log(error));
            },
            fetchAllPermissions() {
                axios.get('/permissions').then(res => {
                    this.all_permissions = res.data;
                }).catch(error => console.log(error));
            },
            destroy(id, index) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/role/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.roles.splice(index, 1);
                }).catch(error => {
                    this.$toastr.e(this.$t(error.response.data.message));
                });
            }
        },
        beforeRouteLeave(to, from, next) {
            this.$store.dispatch('fetchUserPermissions');
            next();
        },
        components: {
            appPermissions
        },
        created() {
            this.fetchRoles();
            this.fetchAllPermissions();
        }
    }
</script>

<style scoped>
    .dropdown-toggle::after {
        display: none;
    }
</style>
