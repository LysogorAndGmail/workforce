<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h2>{{ company.name }}</h2>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="component-box box-white">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="component-box box-white">
                                        <div class="card-body">
                                            <div class="text-center mb-3" v-if="has_logo">
                                                <img :src="'data:image/jpeg;base64, '+logo"
                                                     class="img-thumbnail img-fluid"/><br>
                                                <a href="javascript:void(0)" @click="destroyLogo">{{ $t("delete") }}</a>
                                            </div>
                                            <div class="text-center">
                                                <router-link v-if="permissions.includes('company_update')"
                                                             class="btn btn btn-secondary"
                                                             :to="{name: 'company.edit', params:{company_id: $route.params.company_id}}"
                                                             tag="button">
                                                    {{ $t("edit") }}
                                                </router-link>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped mt-3">
                                                    <tbody>
                                                    <tr>
                                                        <th>{{ $t("status") }}</th>
                                                        <td>
                                                            <i class="fas fa-circle"
                                                               :style="{color:status.color}"></i>
                                                            {{ status.name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("organization") }}</th>
                                                        <td>{{ org.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("name") }}</th>
                                                        <td>{{ company.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("reg") }}</th>
                                                        <td>{{ company.reg }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("vat") }}</th>
                                                        <td>{{ company.vat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("phone") }}</th>
                                                        <td>{{ company.phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("email") }}</th>
                                                        <td v-if="company.email">
                                                            <a :href="'mailto:'+company.email">
                                                                {{ company.email }}
                                                            </a>
                                                        </td>
                                                        <td v-else>-</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("website") }}</th>
                                                        <td v-if="company.website">
                                                            <a :href="'http://'+company.website"
                                                               target="_blank">
                                                                {{ company.website }}
                                                            </a>
                                                        </td>
                                                        <td v-else>-</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("country") }}</th>
                                                        <td>{{ country.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("address") }}</th>
                                                        <td>{{ company.address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("legal_address") }}</th>
                                                        <td>{{ company.legal_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("bank_account") }}</th>
                                                        <td>{{ company.bank_acc }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("operations") }}</th>
                                                        <td>
                                                        <span v-for="(op, i) in operations">
                                                            {{ op.name }}
                                                            <span v-if="i !== operations.length - 1">,</span>
                                                        </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("sub_operations") }}</th>
                                                        <td>
                                                        <span v-for="(op, i) in sub_operations">
                                                            {{ op.name }}
                                                            <span v-if="i !== sub_operations.length - 1">,</span>
                                                        </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("credit_score") }}</th>
                                                        <td>{{ company.credit_score }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("source") }}</th>
                                                        <td>{{ company.source }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ $t("created_by") }}</th>
                                                        <td>
                                                            {{ user.fname }} {{ user.lname }} @
                                                            {{ company.created_at | formatDate }}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12">
                                    <div class="component-box-inner">
                                        <div class="component-box-profile">
                                            <div class="user-profile-layout">
                                                <ul class="nav nav-tabs responsive">
                                                    <li class="nav-item">
                                                        <router-link
                                                                :to="{name: 'company.contacts', params:{company_id:$route.params.company_id}}"
                                                                tag="a"
                                                                class="nav-link show" active-class="active">
                                                            {{ $t("contacts") }}
                                                        </router-link>
                                                    </li>
                                                    <li class="nav-item"
                                                        v-if="permissions.includes('company_branch_read')">
                                                        <router-link
                                                                :to="{name: 'company.branches', params:{company_id:$route.params.company_id}}"
                                                                tag="a"
                                                                class="nav-link show" active-class="active">
                                                            {{ $t("branches") }}
                                                        </router-link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <router-link
                                                                :to="{name: 'company.docs', params:{company_id:$route.params.company_id}}"
                                                                tag="a"
                                                                class="nav-link show" active-class="active">
                                                            {{ $t("documents") }}
                                                        </router-link>
                                                    </li>
                                                    <li class="nav-item" v-if="permissions.includes('workschedule_read')">
                                                        <router-link
                                                                :to="{name: 'company.workschedules', params:{company_id:$route.params.company_id}}"
                                                                tag="a"
                                                                class="nav-link show" active-class="active">
                                                            {{ $t("work_schedules") }}
                                                        </router-link>
                                                    </li>
                                                </ul>
                                                <router-view></router-view>
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
    </section>
</template>

<script>
    import appMultiselect from 'vue-multiselect';
    import CompanyService from '@services/company.service';

    export default {
        data() {
            return {
                company: {},
                operations: [],
                sub_operations: [],
                company: {},
                status: {},
                org: {},
                country: {},
                user: {},
                logo: false,
                has_logo: false
            }
        },
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            fetchCompany() {
                CompanyService.getCompany(this.$route.params.company_id).then(company => {
                    this.company = company;
                    this.status = company.status;
                    this.org = company.organization;
                    this.country = company.country;
                    this.user = company.created_user;
                    if (this.company.logo) {
                        this.has_logo = true;
                    }
                }).then(() => {
                    this.fetchOperations();
                }).catch(error => console.log(error));
            },
            fetchOperations() {
                axios.get('/classifier/operations').then(res => {
                    this.operations = res.data.filter(val => this.company.operations.includes(val.id));
                    let subOperations = [];
                    this.operations.filter(op => {
                        op.sub_operations.filter(subOp => {
                            subOperations.push(subOp);
                        });
                    });
                    this.sub_operations = subOperations.filter(val => this.company.sub_operations.includes(val.id));
                }).catch(error => console.log(error));
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
            this.fetchLogo();
        }
    }
</script>
