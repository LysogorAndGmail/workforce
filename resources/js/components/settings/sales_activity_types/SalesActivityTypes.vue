<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control" :placeholder="$t('filter_by_name')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link v-if="permissions.includes('sales_activity_type_create')"
                                     :to="{name: 'settings.salesactivitytype.create'}" class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_sales_activity_type") }}
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ $t("name") }}</th>
                        <th>{{ $t("show_address") }}</th>
                        <th>{{ $t("roles") }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(sat, index) in filteredSalesActivityTypes">
                        <td>{{ index + 1 }}</td>
                        <td>
                            {{ sat.name }}
                        </td>
                        <td v-if="sat.show_address == 1">
                            {{ $t("yes") }}
                        </td>
                        <td v-else>
                            {{ $t("no") }}
                        </td>
                        <td>
                            <span v-for="(role, i) in sat.roles_full">
                                {{ role.name }}
                                <span v-if="i !== sat.roles_full.length - 1">,</span>
                            </span>
                        </td>
                        <td>
                            <span class="float-right">
                                <router-link
                                        :to="{name: 'settings.salesactivitytype.edit', params:{sales_activity_type_id:sat.id}}"
                                        tag="a" v-if="permissions.includes('sales_activity_type_update')">
                                    {{ $t("edit") }}
                                </router-link>
                                <span v-if="permissions.includes('sales_activity_type_destroy') && permissions.includes('sales_activity_type_update')">|</span>
                                <a href="javascript:void(0)" @click="destroy(sat.id)"
                                   v-if="permissions.includes('sales_activity_type_destroy')">{{ $t("delete") }}</a>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import SalesActivityTypeService from '@services/sales_activity_type.service';

    export default {
        data() {
            return {
                sales_activity_types: [],
                filter_term: '',
            };
        },
        computed: {
            filteredSalesActivityTypes() {
                return this.sales_activity_types.filter(el => {
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
            fetchSalesActivityTypes() {
                SalesActivityTypeService.getSalesActivityTypes().then(res => {
                    this.sales_activity_types = res;
                });
            },
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                SalesActivityTypeService.deleteSalesActivityType(id).then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.fetchSalesActivityTypes();
                }).catch(error => {
                    this.$toastr.e(this.$t(error.response.data));
                });
            }
        },
        created() {
            this.fetchSalesActivityTypes();
        }
    }
</script>
