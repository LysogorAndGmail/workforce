<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h2>{{ $t("edit") }} {{ workforce_job_title.name }}</h2>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="component-box box-white">
                            <div class="component-box-inner">
                                <div class="component-box-profile">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("job_title") }} *</label>
                                                <app-multiselect v-model="selected_job_title"
                                                                 label="name"
                                                                 autocomplete="off"
                                                                 :options="job_titles"
                                                                 track-by="name"
                                                                 :placeholder="$t('choose')"
                                                                 :selectLabel="$t('press_enter_to_select')"
                                                                 :deselectLabel="$t('press_enter_to_remove')"
                                                                 :selectedLabel="$t('selected')"
                                                                 :allow-empty="false">
                                                    <template slot="noOptions" slot-scope="props">
                                                        {{ $t("list_is_empty") }}
                                                    </template>
                                                </app-multiselect>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("first_name") }} *</label>
                                                <input type="text" class="form-control" v-model="form.fname"
                                                       data-vv-name="fname"
                                                       data-vv-as="First Name"
                                                       :class="{'is-invalid': errors.has('fname') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('fname')">
                                                       <strong>{{ errors.first('fname') }}</strong>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("last_name") }} *</label>
                                                <input type="text" class="form-control" v-model="form.lname"
                                                       data-vv-name="lname"
                                                       data-vv-as="Last Name"
                                                       :class="{'is-invalid': errors.has('lname') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('lname')">
                                                   <strong>{{ errors.first('lname') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("phone") }} *</label>
                                                <input type="text" class="form-control" v-model="form.phone"
                                                       data-vv-name="phone"
                                                       data-vv-as="Phone"
                                                       :class="{'is-invalid': errors.has('phone') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('phone')">
                                                    <strong>{{ errors.first('phone') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("email") }} *</label>
                                                <input type="email" class="form-control" v-model="form.email"
                                                       data-vv-name="email"
                                                       data-vv-as="Email"
                                                       :class="{'is-invalid': errors.has('email') }"
                                                       v-validate="'required|email'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('email')">
                                                    <strong>{{ errors.first('email') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("dob") }} *</label>
                                                <datepicker v-model="form.dob" :typeable="false"
                                                            input-class="form-control" format="dd.MM.yyyy"
                                                            :monday-first="true"></datepicker>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("address") }}</label>
                                                <input type="text" class="form-control" v-model="form.address">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("bank_account") }}</label>
                                                <input type="text" class="form-control" v-model="form.bank_acc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("id_code") }}e</label>
                                                <input type="text" class="form-control" v-model="form.idcode">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("recruited_by") }}</label>
                                                <app-multiselect v-model="selected_recruited"
                                                                 label="full_name"
                                                                 autocomplete="off"
                                                                 :options="organization_users"
                                                                 track-by="full_name"
                                                                 :placeholder="$t('choose')"
                                                                 :selectLabel="$t('press_enter_to_select')"
                                                                 :deselectLabel="$t('press_enter_to_remove')"
                                                                 :selectedLabel="$t('selected')"
                                                                 :allow-empty="true">
                                                    <template slot="noOptions" slot-scope="props">
                                                        {{ $t("list_is_empty") }}
                                                    </template>
                                                </app-multiselect>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("linked_user") }}</label>
                                                <app-multiselect v-model="selected_linked_user"
                                                                 label="full_name"
                                                                 autocomplete="off"
                                                                 :options="linked_users"
                                                                 track-by="full_name"
                                                                 :placeholder="$t('choose')"
                                                                 :selectLabel="$t('press_enter_to_select')"
                                                                 :deselectLabel="$t('press_enter_to_remove')"
                                                                 :selectedLabel="$t('selected')"
                                                                 :allow-empty="true">
                                                    <template slot="noOptions" slot-scope="props">
                                                        {{ $t("list_is_empty") }}
                                                    </template>
                                                </app-multiselect>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ $t("is_personnel") }}</label><br/>
                                                        <toggle-button v-model="form.is_personnel"
                                                                       :value="form.is_personnel"
                                                                       :ref="'is_personnel'"
                                                                       :width="80" class="filter-button"
                                                                       :color="{checked: '#5ec58c', unchecked: '#bec7dd'}"
                                                                       :labels="{checked: $t('yes'), unchecked: $t('no')}"/>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ $t("gender") }}</label><br/>
                                                        <toggle-button v-model="form.gender"
                                                                       :value="form.gender" :width="80"
                                                                       :ref="'gender'"
                                                                       class="filter-button"
                                                                       :color="{checked: '#FFC0CB', unchecked: '#6666ff'}"
                                                                       :labels="{checked: $t('female'), unchecked: $t('male')}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
                                        <router-link
                                                :to="{name: 'workforces', params:{workforce_id: $route.params.workforce_id}}"
                                                tag="button" class="btn btn-warning">
                                            {{ $t("cancel") }}
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import appMultiselect from 'vue-multiselect';
    import Datepicker from 'vuejs-datepicker';

    export default {
        data() {
            return {
                form: {},
                workforce_job_title: {},
                job_titles: [],
                selected_job_title: {},
                organization_users: [],
                linked_users: [],
                selected_recruited: {},
                selected_linked_user: {}
            }
        },
        methods: {
            fetchWorkforce() {
                axios.get('/workforce/' + this.$route.params.workforce_id + '/show').then(res => {
                    this.form = res.data;
                    this.workforce_job_title = res.data.job_titles;
                    this.selected_job_title = res.data.job_titles;
                    if (res.data.recruited) {
                        res.data.recruited.full_name = res.data.recruited.fname + ' ' + res.data.recruited.lname;
                        this.selected_recruited = res.data.recruited;
                    }
                    if (res.data.user) {
                        res.data.user.full_name = res.data.user.fname + ' ' + res.data.user.lname;
                        this.selected_linked_user = res.data.user;
                    }
                    this.form.is_personnel = res.data.is_personnel == 1 ? true : false;
                    this.form.gender = res.data.gender == 1 ? true : false;
                    this.$refs['is_personnel'].toggled = this.form.is_personnel;
                    this.$refs['gender'].toggled = this.form.gender;

                }).catch(error => console.log(error));
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.put('/workforce/' + this.$route.params.workforce_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({
                                name: 'workforces'
                            });
                        }).catch(error => console.log(error));
                    }
                });
            },
            prepareForm() {
                let linked_user = '';
                if (this.selected_linked_user) {
                    linked_user = this.selected_linked_user.id;
                }
                this.form = {
                    job_title_id: this.selected_job_title.id,
                    user_id: linked_user,
                    fname: this.form.fname,
                    lname: this.form.lname,
                    gender: this.form.gender,
                    dob: this.form.dob,
                    is_personnel: this.form.is_personnel,
                    phone: this.form.phone,
                    email: this.form.email,
                    recruited_by: this.selected_recruited.id,
                    address: this.form.address,
                    bank_acc: this.form.bank_acc,
                    idcode: this.form.idcode,

                }
            },
            fetchJobTitles() {
                axios.get('/admin/job-titles').then(res => {
                    this.job_titles = res.data;
                }).catch(error => console.log(error));
            },
            fetchOrganizationUsers() {
                axios.get('/organization-users').then(res => {
                    this.organization_users = res.data;
                    let filter_linked_users = [];
                    res.data.filter(el => {
                        if (!el.workforce) {
                            filter_linked_users.push(el);
                        }
                    });
                    this.linked_users = filter_linked_users;
                }).catch(error => console.log(error));
            }
        },
        components: {
            appMultiselect,
            Datepicker
        },
        created() {
            this.fetchWorkforce();
            this.fetchJobTitles();
            this.fetchOrganizationUsers();
        }
    }
</script>
