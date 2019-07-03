<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control" :placeholder="$t('filter_by_name')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link :to="{name: 'admin.settings.job.title.categories.create'}"
                                     class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_category") }}
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
                    <app-job-title-category v-for="(cat, index) in filteredCategories"
                                            :index="index"
                                            :cat="cat"
                                            :key="cat.id"
                                            @removeCategory="removeCategory"></app-job-title-category>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import appJobTitleCategory from './TableRow';

    export default {
        data() {
            return {
                categories: [],
                filter_term: ''
            };
        },
        computed: {
            filteredCategories() {
                return this.categories.filter(el => {
                    if (!el.name) {
                        return false;
                    }
                    return (el.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            }
        },
        methods: {
            fetchJobTitleCategories() {
                axios.get('/admin/job-title-categories').then(res => {
                    this.categories = res.data;
                }).catch(error => console.log(error));
            },
            removeCategory(index) {
                this.categories.splice(index, 1);
            }
        },
        components: {
            appJobTitleCategory
        },
        created() {
            this.fetchJobTitleCategories();
        }
    }
</script>
