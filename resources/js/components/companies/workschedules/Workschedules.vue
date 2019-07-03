<template>
    <div class="tab-content responsive">
        <div class="tab-pane show active">
            <h4>{{ $t("work_schedules") }}</h4>
            <div class="responsive">
                <div class="row mt-2 mb-2">
                    <div class="col-md-7">
                        <input type="text" v-model="filter_term" class="form-control"
                               :placeholder="$t('filter_by_name')">
                    </div>
                    <div class="col-md-5" v-if="permissions.includes('workschedule_create')">
                        <div class="float-right">
                            <router-link :to="{name: 'company.workschedule.create'}"
                                         class="btn btn-secondary"
                                         tag="button">
                                {{ $t("add_new_work_schedule") }}
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <app-company-workschedule v-for="(workschedule, index) in filteredCompanyWorkschedules"
                                            :index="index"
                                            :workschedule="workschedule"
                                            :key="workschedule.id"
                                            @removeCompanyWorkschedule="removeCompanyWorkschedule"></app-company-workschedule>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import appCompanyWorkschedule from './TableRow';
    export default {
        data() {
            return {
                company_workschedules: [],
                filter_term: ''
            };
        },
        computed: {
            filteredCompanyWorkschedules() {
                return this.company_workschedules.filter(el => {
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
            fetchCompanyWorkschedules() {
                axios.get('/workschedules/' + this.$route.params.company_id+'/company').then(res => {
                    this.company_workschedules = res.data;
                }).catch(error => console.log(error));
            },
            removeCompanyWorkschedule(index) {
                this.company_workschedules.splice(index, 1);
            }
        },
        components: {
            appCompanyWorkschedule
        },
        created() {
            this.fetchCompanyWorkschedules();
        }
    }
</script>