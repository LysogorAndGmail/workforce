<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto mt-2">
                    <h4>{{ $t("add_new_work_schedule") }}</h4>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="col">
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
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-secondary" @click="store">{{ $t("save") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: ''
                }
            };
        },
        methods: {
            store() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.post('/workschedule/store', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.$router.push({
                                name: 'company.workschedules',
                                params: {company_id: this.$route.params.company_id}
                            });
                        }).catch(error => console.log(error));
                    }
                });
            },
            prepareForm() {
                this.form = {
                    name: this.form.name,
                    company_id: this.$route.params.company_id,
                }
            }
        }
    }
</script>