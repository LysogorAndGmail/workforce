<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h2>{{ $t("edit") }} {{ form.fname }} {{ form.lname }}</h2>
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
                                                <label>{{ $t("role") }} *</label>
                                                <select class="form-control" v-model="form.role"
                                                        data-vv-name="role"
                                                        data-vv-as="Role"
                                                        :class="{'is-invalid': errors.has('role') }"
                                                        v-validate="'required'">
                                                    <option v-for="(role, i) in roles" :value="role.id">
                                                        {{ role.display_name }}
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('role')">
                                                    <strong>{{ errors.first('role') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("country") }}</label>
                                                <app-multiselect v-model="selected_country"
                                                                 label="name"
                                                                 autocomplete="off"
                                                                 @update="selectedCountry"
                                                                 :placeholder="$t('choose')"
                                                                 :selectLabel="$t('press_enter_to_select')"
                                                                 :deselectLabel="$t('press_enter_to_remove')"
                                                                 :selectedLabel="$t('selected')"
                                                                 :options="countries"
                                                                 :allow-empty="false">
                                                </app-multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
                                        <router-link
                                                :to="{name: 'users'}"
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

    import UserService from '@services/user.service';
    import appMultiselect from 'vue-multiselect';

    export default {
        data() {
            return {
                form: {},
                countries: [],
                selected_country: [],
                roles: []
            }
        },
        methods: {
            fetchUser() {
                UserService.getUser(this.$route.params.user_id).then(user => {
                    this.form = user.user;
                    this.form.role = user.roles[0].id;
                    this.selected_country = user.user.country;
                })
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.form.country_id = this.selected_country.id;
                        UserService.updateUser(this.$route.params.user_id, this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({
                                name: 'users'
                            });
                        }).catch(error => console.log(error));
                    }
                });
            },
            fetchRoles() {
                axios.get('/roles').then(res => {
                    this.roles = res.data;
                }).catch(error => console.log(error));
            },
            selectedCountry(selected) {
                this.selected_country = selected;
            },
            fetchCountries() {
                axios.get('/classifier/countries').then(res => {
                    this.countries = res.data;
                }).catch(error => console.log(error));
            }
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchUser();
            this.fetchRoles();
            this.fetchCountries();
        }
    }
</script>
