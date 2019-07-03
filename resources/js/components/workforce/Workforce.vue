<template>
    <div class="container">
        <div class="element-header row align-items-center">
            <div class="col-md-auto mr-auto">
                <h2>{{ $t("workforce") }}</h2>
            </div>
        </div>
        <div class="element-body">
            <div class="row component-boxes">
                <div class="col-12">
                    <div class="component-box box-white">
                        <div class="component-box-inner">
                            <div class="component-box-profile">
                                <div class="user-profile-layout">
                                    <div class="responsive">
                                        <div class="row mt-2 mb-2">
                                            <div class="col-md-7">
                                                <input type="text" v-model="filter_term" class="form-control"
                                                       :placeholder="$t('filter_by_job_title')">
                                            </div>
                                            <div class="col-md-5" v-if="permissions.includes('workforce_create')">
                                                <div class="float-right">
                                                    <router-link :to="{name: 'workforce.create'}"
                                                                 class="btn btn-secondary"
                                                                 tag="button">
                                                        {{ $t("add_new_workforce") }}
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ $t("first_name") }}</th>
                                                    <th>{{ $t("last_name") }}</th>
                                                    <th>{{ $t("job_title") }}</th>
                                                    <th>{{ $t("organization") }}</th>
                                                    <th>{{ $t("gender") }}</th>
                                                    <th>{{ $t("dob") }}</th>
                                                    <th>{{ $t("is_personnel") }}</th>
                                                    <th>{{ $t("phone") }}</th>
                                                    <th>{{ $t("email") }}</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <app-workforce v-for="(workforce, index) in filteredWorkforce"
                                                               :index="index"
                                                               :workforce="workforce"
                                                               :key="workforce.id"
                                                               @removeWorkforce="removeWorkforce"></app-workforce>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import appWorkforce from './TableRow';

    export default {
        data() {
            return {
                workforces: [],
                filter_term: ''
            };
        },
        computed: {
            filteredWorkforce() {
                return this.workforces.filter(el => {
                    if (!el.job_titles.name) {
                        return false;
                    }
                    return (el.job_titles.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            },
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            fetchWorkforces() {
                axios.get('/workforces').then(res => {
                    this.workforces = res.data;
                }).catch(error => console.log(error));
            },
            removeWorkforce(index) {
                this.workforces.splice(index, 1);
            }
        },
        components: {
            appWorkforce
        },
        created() {
            this.fetchWorkforces();
        }
    }
</script>
