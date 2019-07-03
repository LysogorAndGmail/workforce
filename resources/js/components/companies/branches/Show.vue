<template>
    <div class="tab-content responsive">
        <div class="tab-pane show active">
            <div class="responsive">
                <div class="row component-boxes">
                    <div class="col-md-3 col-sm-12">
                        <h4 class="mt-2 mb-2">{{ branch.name }}</h4>
                        <div class="row">
                            <div class="col">
                                <p><b>{{ $t("name") }}</b></p>
                                <p><b>{{ $t("phone") }}</b></p>
                                <p><b>{{ $t("email") }}</b></p>
                                <p><b>{{ $t("address") }}</b></p>
                                <p><b>{{ $t("color") }}</b></p>
                            </div>
                            <div class="col">
                                <p>{{ branch.name }}</p>
                                <p>{{ branch.phone }}</p>
                                <p v-if="branch.email">
                                    <a :href="'mailto:'+branch.email">
                                        {{ branch.email }}
                                    </a>
                                </p>
                                <p v-else>-</p>
                                <p>{{ branch.address }}</p>
                                <p><i class="fas fa-circle" :style="{color:branch.color}"></i></p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <router-link v-if="permissions.includes('company_branch_update')"
                                         class="btn btn btn-secondary"
                                         :to="{name: 'company.branche.edit', params:{branch_id: $route.params.branch_id}}"
                                         tag="button">
                                {{ $t("edit") }}
                            </router-link>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-7">
                                <h4>{{ $t("branch_contacts") }}</h4>
                            </div>
                            <div class="col-md-5" v-if="permissions.includes('company_contact_create')">
                                <div class="float-right">
                                    <router-link :to="{name: 'company.contact.create'}"
                                                 class="btn btn-secondary"
                                                 tag="button">
                                        {{ $t("add_new_contact") }}
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ $t("job_title") }}</th>
                                    <th>{{ $t("first_name") }}</th>
                                    <th>{{ $t("last_name") }}</th>
                                    <th>{{ $t("phone") }}</th>
                                    <th>{{ $t("email") }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(contact, index) in branch.contacts">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ contact.job_title }}</td>
                                    <td>{{ contact.fname }}</td>
                                    <td>{{ contact.lname }}</td>
                                    <td>{{ contact.phone }}</td>
                                    <td v-if="contact.email">
                                        <a :href="'mailto:'+contact.email">
                                            {{ contact.email }}
                                        </a>
                                    </td>
                                    <td v-else>-</td>
                                    <td>
                                        <span class="float-right">
                                        <router-link
                                                :to="{name: 'company.contact.edit', params:{contact_id:contact.id}}"
                                                v-if="permissions.includes('company_contact_update')"
                                                tag="a">
                                            {{ $t("edit") }}
                                        </router-link><span
                                                v-if="permissions.includes('company_contact_update') && permissions.includes('company_contact_destroy')"> | </span>
                                            <a href="javascript:void(0)"
                                               v-if="permissions.includes('company_contact_destroy')"
                                               @click="destroy(contact.id, index)">{{ $t("delete") }}</a>
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                branch: {},
            }
        },
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            fetchCompanyBranch() {
                axios.get('/company-branch/' + this.$route.params.branch_id + '/show').then(res => {
                    this.branch = res.data;
                }).catch(error => console.log(error));
            },
            destroy(id, index) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/company-contact/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.branch.contacts.splice(index, 1);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        },
        created() {
            this.fetchCompanyBranch();
        }
    }
</script>
