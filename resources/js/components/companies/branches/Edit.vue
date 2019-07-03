<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto mt-2">
                    <h4>{{ $t("edit") }} {{ form.name }}</h4>
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
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("address") }} *</label>
                                    <input type="text"
                                           v-model="form.address"
                                           data-vv-name="address"
                                           data-vv-as="Address"
                                           :class="{'form-control': true, 'is-invalid': errors.has('address') }"
                                           v-validate="'required'">
                                    <span class="invalid-feedback" role="alert"
                                          v-show="errors.has('address')">
                                        <strong>{{ errors.first('address') }}</strong>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("phone") }}</label>
                                    <input type="text" class="form-control" v-model="form.phone">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("email") }}</label>
                                    <input type="email" class="form-control" v-model="form.email"
                                           data-vv-name="email"
                                           data-vv-as="Email"
                                           :class="{'form-control': true, 'is-invalid': errors.has('email') }"
                                           v-validate="'email'">
                                    <span class="invalid-feedback" role="alert"
                                          v-show="errors.has('email')">
                                        <strong>{{ errors.first('email') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("color") }}</label>
                                    <input type="color" class="form-control" v-model="form.color">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
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
                form: {}
            };
        },
        methods: {
            fetchCompanyBranch() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.get('/company-branch/' + this.$route.params.branch_id + '/show').then(res => {
                            this.form = res.data;
                        }).catch(error => console.log(error));
                    }
                });
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.put('/company-branch/' + this.$route.params.branch_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({
                                name: 'company.branches',
                                params: {company_id: this.$route.params.company_id}
                            });
                        }).catch(error => console.log(error));
                    }
                });
            }
        },
        created() {
            this.fetchCompanyBranch();
        }
    }
</script>
