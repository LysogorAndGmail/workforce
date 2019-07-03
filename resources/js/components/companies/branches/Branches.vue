<template>
    <div class="tab-content responsive">
        <div class="tab-pane show active">
            <h4>{{ $t("branches") }}</h4>
            <div class="responsive">
                <div class="row mt-2 mb-2">
                    <div class="col-md-7">
                        <input type="text" v-model="filter_term" class="form-control"
                               :placeholder="$t('filter_by_name')">
                    </div>
                    <div class="col-md-5" v-if="permissions.includes('company_branch_create')">
                        <div class="float-right">
                            <router-link :to="{name: 'company.branche.create'}"
                                         class="btn btn-secondary"
                                         tag="button">
                                {{ $t("add_new_branch") }}
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
                            <th>{{ $t("address") }}</th>
                            <th>{{ $t("phone") }}</th>
                            <th>{{ $t("email") }}</th>
                            <th>{{ $t("color") }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <app-company-branch v-for="(branch, index) in filteredCompanyBranches"
                                            :index="index"
                                            :branch="branch"
                                            :key="branch.id"
                                            @removeCompanyBranch="removeCompanyBranch"></app-company-branch>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import appCompanyBranch from './TableRow';

    export default {
        data() {
            return {
                company_branches: [],
                filter_term: ''
            };
        },
        computed: {
            filteredCompanyBranches() {
                return this.company_branches.filter(el => {
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
            fetchCompanyBranches() {
                axios.get('/company-branches/' + this.$route.params.company_id).then(res => {
                    this.company_branches = res.data;
                }).catch(error => console.log(error));
            },
            removeCompanyBranch(index) {
                this.company_branches.splice(index, 1);
            }
        },
        components: {
            appCompanyBranch
        },
        created() {
            this.fetchCompanyBranches();
        }
    }
</script>