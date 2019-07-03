<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control" :placeholder="$t('filter_by_name')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link :to="{name: 'settings.company.status.create'}" class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_company_status") }}
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
                        <th>{{ $t("organization") }}</th>
                        <th>{{ $t("color") }}</th>
                        <th>{{ $t("reason") }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <app-company-statuses v-for="(company_status, index) in filteredCompanyStatuses"
                                          :index="index"
                                          :company_status="company_status"
                                          :key="company_status.id"
                                          @removeCompanyStatus="removeCompanyStatus"></app-company-statuses>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import appCompanyStatuses from './TableRow';

    export default {
        data() {
            return {
                company_statuses: [],
                filter_term: '',
            };
        },
        computed: {
            filteredCompanyStatuses() {
                return this.company_statuses.filter(el => {
                    if (!el.name) {
                        return false;
                    }
                    return (el.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            }
        },
        methods: {
            fetchCompanyStatuses() {
                axios.get('/company-statuses').then(res => {
                    this.company_statuses = res.data;
                }).catch(error => console.log(error));
            },
            removeCompanyStatus(index) {
                this.company_statuses.splice(index, 1);
            }
        },
        components: {
            appCompanyStatuses
        },
        created() {
            this.fetchCompanyStatuses();
        }
    }
</script>
