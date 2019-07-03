<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("edit") }} {{ form.name }}</h4>
            <div class="row">
                <div class="col-md-6">
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
                        <label>{{ $t("reason") }} *</label>
                        <input type="text"
                               v-model="form.reason"
                               data-vv-name="reason"
                               data-vv-as="Reason"
                               :class="{'form-control': true, 'is-invalid': errors.has('reason') }"
                               v-validate="'required'">
                        <span class="invalid-feedback" role="alert" v-show="errors.has('reason')">
                            <strong>{{ errors.first('reason') }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>{{ $t("color") }} *</label>
                        <input type="color" class="form-control" v-model="form.color"
                               data-vv-name="color"
                               data-vv-as="Color"
                               :class="{'form-control': true, 'is-invalid': errors.has('color') }"
                               v-validate="'required'">
                        <span class="invalid-feedback" role="alert" v-show="errors.has('color')">
                            <strong>{{ errors.first('color') }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                form: {},
            };
        },
        methods: {
            fetchCompanyStatus() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.get('/company-status/' + this.$route.params.company_status_id + '/show').then(res => {
                            this.form = res.data;
                        }).catch(error => console.log(error));
                    }
                });
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.put('/company-status/' + this.$route.params.company_status_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({name: 'settings.company.statuses'});
                        }).catch(error => console.log(error));
                    }
                });
            }
        },
        created() {
            this.fetchCompanyStatus();
        }
    }
</script>
