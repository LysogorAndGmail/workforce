<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto mt-2">
                    <h4>{{ $t("add_new_branch") }}</h4>
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
                    color: '#000000'
                }
            };
        },
        methods: {
            store() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.post('/company-branch/store', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.$router.push({
                                name: 'company.branches',
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
                    address: this.form.address,
                    phone: this.form.phone,
                    email: this.form.email,
                    color: this.form.color
                }
            }
        }
    }
</script>