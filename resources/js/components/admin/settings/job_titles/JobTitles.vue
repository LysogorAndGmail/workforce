<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control" :placeholder="$t('filter_by_name')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link :to="{name: 'admin.settings.job.title.create'}" class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_job_title") }}
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
                        <th>{{ $t("category") }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <app-job-title v-for="(job_title, index) in filteredJobTitles"
                                   :index="index"
                                   :job_title="job_title"
                                   :key="job_title.id"
                                   @removeJobTitle="removeJobTitle"></app-job-title>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import appJobTitle from './TableRow';

    export default {
        data() {
            return {
                job_titles: [],
                filter_term: ''
            };
        },
        computed: {
            filteredJobTitles() {
                return this.job_titles.filter(el => {
                    if (!el.name) {
                        return false;
                    }
                    return (el.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            }
        },
        methods: {
            fetchJobTitles() {
                axios.get('/admin/job-titles').then(res => {
                    this.job_titles = res.data;
                }).catch(error => console.log(error));
            },
            removeJobTitle(index) {
                this.job_titles.splice(index, 1);
            }
        },
        components: {
            appJobTitle
        },
        created() {
            this.fetchJobTitles();
        }
    }
</script>
