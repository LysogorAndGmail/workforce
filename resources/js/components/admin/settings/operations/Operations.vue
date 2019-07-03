<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control" :placeholder="$t('filter_by_name')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link :to="{name: 'admin.settings.operations.create'}" class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_operation") }}
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
                    <app-operations v-for="(operation, index) in filteredOperations"
                                    :index="index"
                                    :operation="operation"
                                    :key="operation.id"
                                    @removeOperation="removeOperation"></app-operations>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import appOperations from './TableRow';

    export default {
        data() {
            return {
                operations: [],
                filter_term: ''
            };
        },
        computed: {
            filteredOperations() {
                return this.operations.filter(el => {
                    if (!el.name) {
                        return false;
                    }
                    return (el.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            }
        },
        methods: {
            fetchOperations() {
                axios.get('/admin/operations').then(res => {
                    this.operations = res.data;
                }).catch(error => console.log(error));
            },
            removeOperation(index) {
                this.operations.splice(index, 1);
            }
        },
        components: {
            appOperations
        },
        created() {
            this.fetchOperations();
        }
    }
</script>
