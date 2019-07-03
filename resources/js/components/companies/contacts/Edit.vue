<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto mt-2">
                    <h4>{{ $t("edit") }} {{ contact.fname }}</h4>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("first_name") }} *</label>
                                    <input type="text"
                                           v-model="contact.fname"
                                           data-vv-name="fname"
                                           data-vv-as="First Name"
                                           :class="{'form-control': true, 'is-invalid': errors.has('fname') }"
                                           v-validate="'required'">
                                    <span class="invalid-feedback" role="alert" v-show="errors.has('fname')">
                                        <strong>{{ errors.first('fname') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("last_name") }}e</label>
                                    <input type="text" class="form-control" v-model="contact.lname">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("branch") }}</label>
                                    <app-multiselect v-model="contact.branch"
                                                     :placeholder="$t('choose')"
                                                     :selectLabel="$t('press_enter_to_select')"
                                                     :deselectLabel="$t('press_enter_to_remove')"
                                                     :selectedLabel="$t('selected')"
                                                     label="name"
                                                     autocomplete="off"
                                                     :options="branches"
                                                     track-by="name"
                                                     :allow-empty="true">
                                        <template slot="noOptions" slot-scope="props">
                                            {{ $t("list_is_empty") }}
                                        </template>
                                    </app-multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("phone") }}</label>
                                    <input type="text" class="form-control" v-model="contact.phone">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{ $t("email") }}</label>
                                    <input type="email" class="form-control" v-model="contact.email"
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
                                    <label>{{ $t("job_title") }}</label>
                                    <input type="text" class="form-control" v-model="contact.job_title">
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

    import appMultiselect from 'vue-multiselect';

    export default {
        data() {
            return {
                form: {},
                contact: {},
                branches: [],
                selected_branch: ''
            };
        },
        methods: {
            fetchCompanyContact() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.get('/company-contact/' + this.$route.params.contact_id + '/show').then(res => {
                            this.contact = res.data;
                            this.contact.branch = res.data.company_branch;
                        }).catch(error => console.log(error));
                    }
                });
            },
            fetchCompanyBranches() {
                axios.get('/company-branches/' + this.$route.params.company_id).then(res => {
                    this.branches = res.data;
                }).catch(error => console.log(error));
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.put('/company-contact/' + this.$route.params.contact_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({
                                name: 'company.contacts',
                                params: {company_id: this.$route.params.company_id}
                            });
                        }).catch(error => console.log(error));
                    }
                });
            },
            prepareForm() {
                if (this.form.branch) {
                    this.selected_branch = this.form.branch.id;
                }
                this.form = {
                    fname: this.contact.fname,
                    lname: this.contact.lname,
                    branch: this.selected_branch,
                    phone: this.contact.phone,
                    email: this.contact.email,
                    job_title: this.contact.job_title

                }
            },
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchCompanyContact();
            this.fetchCompanyBranches();
        }
    }
</script>
