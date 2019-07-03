<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("add_new_sub_operation") }}</h4>
            <div class="form-group">
                <label>{{ $t("name") }} *</label>
                <input type="text"
                       v-model="form.name"
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
                                 data-vv-name="operation"
                                 data-vv-as="Operation"
                                 v-validate="'required'"
                                 @update="selectedOperation"
                                 label="name"
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
                <button class="btn btn-secondary" @click="store">{{ $t("save") }}</button>
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
                operations: [],
                selected_operation: []
            };
        },
        methods: {
            store() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.form.operation_id = this.selected_operation.id;
                        axios.post('/admin/sub-operation/store', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.$router.push({name: 'admin.settings.sub.operations'});
                        }).catch(error => console.log(error));
                    }
                });
            },
            fetchOperations() {
                axios.get('/admin/operations').then(res => {
                    this.operations = res.data;
                }).catch(error => console.log(error));
            },
            selectedOperation(selected) {
                this.selected_operation = selected;
            },
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchOperations();
        }
    }
</script>