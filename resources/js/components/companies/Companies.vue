<template>
    <div class="container">
        <div class="element-header row align-items-center">
            <div class="col-md-auto mr-auto">
                <h2>{{ $t("companies") }}</h2>
            </div>
        </div>
        <div class="element-body">
            <div class="row component-boxes">
                <div class="col-12">
                    <div class="component-box box-white">
                        <div class="component-box-inner">
                            <div class="component-box-profile">
                                <div class="user-profile-layout">
                                    <div class="responsive">
                                        <div class="row mt-2 mb-2">
                                            <div class="col-md-7">
                                                <input type="text" v-model="filter_term" class="form-control"
                                                       :placeholder="$t('filter_by_name')"
                                                       @keyup.enter="searchCompanies">
                                            </div>
                                            <div class="col-md-5" v-if="permissions.includes('company_create')">
                                                <div class="float-right">
                                                    <router-link :to="{name: 'company.create'}"
                                                                 class="btn btn-secondary"
                                                                 tag="button">
                                                        {{ $t("add_new_company") }}
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ $t("name") }}</th>
                                                    <th>{{ $t("status") }}</th>
                                                    <th>{{ $t("reg") }}</th>
                                                    <th>{{ $t("address") }}</th>
                                                    <th>{{ $t("website") }}</th>
                                                    <th>{{ $t("phone") }}</th>
                                                    <th>{{ $t("email") }}</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <app-company v-for="(company, index) in companies"
                                                             :index="index"
                                                             :company="company"
                                                             :key="company.id"
                                                             @removeCompany="removeCompany"></app-company>
                                                </tbody>
                                                <tr v-if="no_results">
                                                    <th colspan="8" class="text-center">{{ $t("list_is_empty") }}</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import appCompany from './TableRow';
    import CompanyService from '@services/company.service';

    export default {
        data() {
            return {
                companies: [],
                filter_term: '',
                no_results: false
            };
        },
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            removeCompany(index) {
                this.companies.splice(index, 1);
            },
            searchCompanies() {
                if (this.filter_term.length > 0) {
                    CompanyService.searchCompanies(this.filter_term).then(companies => {
                        this.companies = companies;
                        if (this.companies.length == 0) {
                            this.no_results = true;
                        } else {
                            this.no_results = false;
                        }
                    });
                } else {
                    this.companies = [];
                }

            }
        },
        components: {
            appCompany
        }
    }
</script>
