<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("edit") }} {{ sub_operation.name }}</h4>
            <div class="form-group">
                <label>{{ $t("name") }} *</label>
                <input type="text"
                       v-model="sub_operation.name"
                       data-vv-name="name"
                       data-vv-as="Name"
                       :class="{'form-control': true, 'is-invalid': errors.has('name') }"
                       v-validate="'required'">
                <span class="invalid-feedback" role="alert" v-show="errors.has('name')">
                    <strong>{{ errors.first('name') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>{{ $t("operation") }} *</label>
                <app-multiselect v-model="selected_operation"
                                 label="name"
                                 data-vv-name="operation"
                                 data-vv-as="Operation"
                                 v-validate="'required'"
                                 :placeholder="$t('choose')"
                                 :selectLabel="$t('press_enter_to_select')"
                                 :deselectLabel="$t('press_enter_to_remove')"
                                 :selectedLabel="$t('selected')"
                                 :options="operations"
                                 :allow-empty="false">
                    <template slot="noOptions" slot-scope="props">
                        {{ $t("list_is_empty") }}
                    </template>
                </app-multiselect>
                <span v-show="errors.has('operation')" class="help is-danger validation_error" role="alert">
                    <strong>{{ errors.first('operation') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
            </div>
        </div>
    </div>
</template>

<script>
    import appMultiselect from 'vue-multiselect';

    export default {
        data() {
            return {
                form: {},
                sub_operation: {},
                operations: [],
                selected_operation: {}
            };
        },
        methods: {
            fetchSubOperation() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.get('/admin/sub-operation/' + this.$route.params.sub_operation_id + '/show').then(res => {
                            this.sub_operation = res.data;
                            this.selected_operation = res.data.operation;
                        }).catch(error => console.log(error));
                    }
                });
            },
            prepareForm() {
                this.form = {
                    name: this.sub_operation.name,
                    operation_id: this.selected_operation.id
                }
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.put('/admin/sub-operation/' + this.$route.params.sub_operation_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({name: 'admin.settings.sub.operations'});
                        }).catch(error => console.log(error));
                    }
                });
            },
            fetchOperation() {
                axios.get('/admin/operations').then(res => {
                    this.operations = res.data;
                }).catch(error => console.log(error));
            }
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchSubOperation();
            this.fetchOperation();
        }
    }
</script>
