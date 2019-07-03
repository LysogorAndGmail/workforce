<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h2>{{ $t("edit") }} {{ form.name }}</h2>
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
                                                <label>{{ $t("reg") }} *</label>
                                                <input type="text"
                                                       v-model="form.reg"
                                                       data-vv-name="reg"
                                                       data-vv-as="Reg"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('reg') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert" v-show="errors.has('reg')">
                                                    <strong>{{ errors.first('reg') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("status") }} *</label>
                                                <app-multiselect v-model="selected_status"
                                                                 label="name"
                                                                 autocomplete="off"
                                                                 :placeholder="$t('choose')"
                                                                 :selectLabel="$t('press_enter_to_select')"
                                                                 :deselectLabel="$t('press_enter_to_remove')"
                                                                 :selectedLabel="$t('selected')"
                                                                 :options="statuses"
                                                                 track-by="name"
                                                                 :allow-empty="false">
                                                    <template slot="noOptions" slot-scope="props">
                                                        {{ $t("list_is_empty") }}
                                                    </template>
                                                </app-multiselect>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("country") }} *</label>
                                                <app-multiselect v-model="selected_country"
                                                                 label="name"
                                                                 autocomplete="off"
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
                                    <div class="form-row">
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
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("legal_address") }} *</label>
                                                <input type="text"
                                                       v-model="form.legal_address"
                                                       data-vv-name="legal_address"
                                                       data-vv-as="Legal Address"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('legal_address') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('legal_address')">
                                                    <strong>{{ errors.first('legal_address') }}</strong>
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
                                                <input type="email" class="form-control" v-model="form.email">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("website") }}</label>
                                                <input type="text" class="form-control" v-model="form.website">
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
                                                <label>{{ $t("vat") }}</label>
                                                <input type="text" v-model="form.vat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("operations") }}</label>
                                                <app-multiselect v-model="selected_operations"
                                                                 :options="operations"
                                                                 @input="operationChange"
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
                                                                {{ op.name }}
                                                                <span v-if="i !== values.length - 1">,</span>
                                                            </span>
                                                        </span>
                                                    </template>
                                                </app-multiselect>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("sub_operations") }}</label>
                                                <app-multiselect v-model="selected_sub_operations"
                                                                 :options="sub_operations"
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
                                                                {{ op.name }}
                                                                <span v-if="i !== values.length - 1">,</span>
                                                            </span>
                                                        </span>
                                                    </template>
                                                </app-multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("credit_score") }}</label>
                                                <p>Will do later</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("source") }} *</label>
                                                <input type="text"
                                                       v-model="form.source"
                                                       data-vv-name="source"
                                                       data-vv-as="Source"
                                                       :class="{'form-control': true, 'is-invalid': errors.has('source') }"
                                                       v-validate="'required'">
                                                <span class="invalid-feedback" role="alert"
                                                      v-show="errors.has('source')">
                                                    <strong>{{ errors.first('source') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ $t("logo") }}</label>
                                                <div class="text-center" v-if="has_logo">
                                                    <img :src="'data:image/jpeg;base64, '+logo"
                                                         class="img-thumbnail img-fluid"/><br>
                                                    <a href="javascript:void(0)" @click="destroyLogo">Delete logo</a>
                                                </div>
                                                <div v-else>
                                                    <app-file-upload
                                                            :placeholder="$t('choose')"
                                                            class="img-upload"
                                                            accept="image/png,image/jpeg"
                                                            :max-size="max_img_size"
                                                            @size-exceeded="onSizeExceeded"
                                                            @load="onLoad"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
                                        <router-link
                                                :to="{name: 'company.contacts', params:{company_id: $route.params.company_id}}"
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
    import CompanyService from '@services/company.service';

    export default {
        data() {
            return {
                max_img_size: 3, // megabytes
                form: {},
                has_logo: false,
                logo: null,
                countries: [],
                selected_country: {},
                statuses: [],
                selected_status: {},
                operations: [],
                selected_operations: [],
                sub_operations: [],
                selected_sub_operations: []
            };
        },
        methods: {
            fetchCompany() {
                CompanyService.getCompany(this.$route.params.company_id).then(company => {
                    this.form = company;
                    this.selected_country = company.country;
                    this.selected_status = company.status;
                    if (this.form.logo) {
                        this.has_logo = true;
                    }
                }).then(() => {
                    this.fetchOperations();
                }).catch(error => console.log(error));
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        CompanyService.updateCompany(this.$route.params.company_id, this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({
                                name: 'company.branches',
                                params: {company_id: this.$route.params.company_id}
                            });
                        }).catch(error => console.log(error));
                    }
                });
            },
            prepareForm() {
                let operations = [];
                this.selected_operations.filter(el => {
                    operations.push(el.id);
                });
                let subOperations = [];
                this.selected_sub_operations.filter(el => {
                    subOperations.push(el.id);
                });
                this.form = {
                    name: this.form.name,
                    logo: this.logo,
                    country_id: this.selected_country.id,
                    status_id: this.selected_status.id,
                    reg: this.form.reg,
                    vat: this.form.vat,
                    legal_address: this.form.legal_address,
                    address: this.form.address,
                    website: this.form.website,
                    phone: this.form.phone,
                    email: this.form.email,
                    bank_acc: this.form.bank_acc,
                    source: this.form.source,
                    operations: operations,
                    sub_operations: subOperations,
                }
            },
            fetchOperations() {
                axios.get('/classifier/operations').then(res => {
                    this.operations = res.data;
                    this.selected_operations = res.data.filter(val => this.form.operations.includes(val.id));
                    let subOperations = [];
                    this.selected_operations.filter(op => {
                        op.sub_operations.filter(subOp => {
                            subOperations.push(subOp);
                        });
                    });
                    this.sub_operations = subOperations;
                    this.selected_sub_operations = subOperations.filter(val => this.form.sub_operations.includes(val.id));
                }).catch(error => console.log(error));
            },
            operationChange() {
                let subOperations = [];
                this.selected_sub_operations = [];
                this.selected_operations.filter(op => {
                    op.sub_operations.filter(subOp => {
                        subOperations.push(subOp);
                    });
                });
                this.sub_operations = subOperations;
            },
            fetchCountries() {
                axios.get('/classifier/countries').then(res => {
                    this.countries = res.data;
                }).catch(error => console.log(error));
            },
            fetchStatuses() {
                axios.get('/company-statuses').then(res => {
                    this.statuses = res.data;
                }).catch(error => console.log(error));
            },
            onLoad(dataUri) {
                this.logo = dataUri;
            },
            onSizeExceeded(size) {
                alert(`Image ${size}Mb size exceeds limits of ${this.max_img_size}Mb!`);
            },
            fetchLogo() {
                axios.get('/company/' + this.$route.params.company_id + '/logo/show').then(res => {
                    this.logo = res.data;
                }).catch(error => console.log(error));
            },
            destroyLogo() {
                if (!window.confirm('Delete ?')) {
                    return false;
                }
                axios.delete('/company/' + this.$route.params.company_id + '/logo/destroy').then(res => {
                    this.has_logo = false;
                    this.$toastr.s(this.$t("deleted"));
                }).catch(error => console.log(error));
            }
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchCompany();
            this.fetchCountries();
            this.fetchStatuses();
            this.fetchLogo();
        }
    }
</script>

<style scoped>
    .img-upload {
        max-width: 180px;
    }
</style>
