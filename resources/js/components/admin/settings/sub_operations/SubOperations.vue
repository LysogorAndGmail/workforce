<template>
    <div class="tab-content responsive">
        <div class="tab-pane active">
            <div class="row mt-2 mb-2">
                <div class="col-md-7">
                    <input type="text" v-model="filter_term" class="form-control" :placeholder="$t('filter_by_name')">
                </div>
                <div class="col-md-5">
                    <div class="float-right">
                        <router-link :to="{name: 'admin.settings.sub.operation.create'}" class="btn btn-secondary"
                                     tag="button">
                            {{ $t("add_new_sub_operation") }}
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
                        <th>{{ $t("operation") }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <app-sub-operation v-for="(sub_operation, index) in filteredSubOperations"
                                       :index="index"
                                       :sub_operation="sub_operation"
                                       :key="sub_operation.id"
                                       @removeSubOperation="removeSubOperation"></app-sub-operation>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import appSubOperation from './TableRow';

    export default {
        data() {
            return {
                sub_operations: [],
                filter_term: ''
            };
        },
        computed: {
            filteredSubOperations() {
                return this.sub_operations.filter(el => {
                    if (!el.name) {
                        return false;
                    }
                    return (el.name).toLowerCase().match((this.filter_term).toLowerCase());
                });
            }
        },
        methods: {
            fetchSubOperations() {
                axios.get('/admin/sub-operations').then(res => {
                    this.sub_operations = res.data;
                }).catch(error => console.log(error));
            },
            removeSubOperation(index) {
                this.sub_operations.splice(index, 1);
            }
        },
        components: {
            appSubOperation
        },
        created() {
            this.fetchSubOperations();
        }
    }
</script>
