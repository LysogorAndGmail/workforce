<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="row">
                <div class="col-md-6">
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
                            <label>{{ $t("roles") }}</label>
                            <app-multiselect v-model="selected_roles"
                                             :options="roles"
                                             data-vv-name="roles"
                                             data-vv-as="Roles"
                                             v-validate="'required'"
                                             :multiple="true"
                                             :placeholder="$t('choose')"
                                             :selectLabel="$t('press_enter_to_select')"
                                             :deselectLabel="$t('press_enter_to_remove')"
                                             :selectedLabel="$t('selected')"
                                             label="name"
                                             track-by="name">
                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single"
                                          v-if="values.length &amp;&amp; !isOpen">
                                        <span v-for="(op, i) in values">
                                            {{ op.name }}<span
                                                v-if="i !== values.length - 1">,</span>
                                        </span>
                                    </span>
                                </template>
                            </app-multiselect>
                            <span v-show="errors.has('roles')"
                                  class="help is-danger validation_error" role="alert">
                                <strong>{{ errors.first('roles') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>{{ $t("show_address") }}</label><br/>
                            <toggle-button v-model="form.show_address" :width="80"
                                           class="filter-button"
                                           :ref="'show_address'"
                                           :color="{checked: '#5ec58c', unchecked: '#bec7dd'}"
                                           :labels="{checked: $t('yes'), unchecked: $t('no')}"/>
                        </div>
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

    import SalesActivityTypeService from '@services/sales_activity_type.service';
    import RoleService from '@services/role.service';
    import appMultiselect from 'vue-multiselect';

    export default {
        data() {
            return {
                form: {},
                roles: [],
                selected_roles: []
            };
        },
        methods: {
            fetchSalesActivityType() {
                SalesActivityTypeService.getSalesActivityType(this.$route.params.sales_activity_type_id).then(sat => {
                    this.form = sat;
                    this.form.show_address = sat.show_address == 1 ? true : false;
                    this.$refs['show_address'].toggled = this.form.show_address;
                })
            },
            fetchRoles() {
                RoleService.getRoles().then(roles => {
                    this.roles = roles;
                }).then(res => {
                    this.roles.filter(role => {
                        if (this.form.roles.includes(role.id)) {
                            this.selected_roles.push(role);
                        }
                    })
                })
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        let roles = [];
                        this.selected_roles.filter(el => {
                            roles.push(el.id);
                        });
                        this.form.roles = roles;
                        SalesActivityTypeService.updateSalesActivityType(this.$route.params.sales_activity_type_id, this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({name: 'settings.salesactivitytypes'});
                        }).catch(error => console.log(error));

                    }
                });
            }
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchRoles();
            this.fetchSalesActivityType();
        }
    }
</script>
