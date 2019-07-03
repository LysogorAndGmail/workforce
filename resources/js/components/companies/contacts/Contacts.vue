<template>
    <div class="tab-content responsive">
        <div class="tab-pane show active">
            <h4>{{ $t("contacts") }}</h4>
            <div class="responsive">
                <div class="row mt-2 mb-2">
                    <div class="col-md-7">
                        <input type="text" v-model="filter_term" class="form-control"
                               :placeholder="$t('filter_by_first_name')">
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
                        <app-company-contact v-for="(contact, index) in filteredCompanyContacts"
                                            :index="index"
                                            :contact="contact"
                                            :key="contact.id"
                                            @removeCompanyContact="removeCompanyContact"></app-company-contact>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import appCompanyContact from './TableRow';

    export default {
        data() {
            return {
                company_contacts: [],
                filter_term: ''
            };
        },
        computed: {
            filteredCompanyContacts() {
                return this.company_contacts.filter(el => {
                    if (!el.fname) {
                        return false;
                    }
                    return (el.fname).toLowerCase().match((this.filter_term).toLowerCase());
                });
            },
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            fetchCompanyContacts() {
                axios.get('/company-contacts/' + this.$route.params.company_id).then(res => {
                    this.company_contacts = res.data;                
                }).catch(error => console.log(error));
            },
            removeCompanyContact(index) {
                this.company_contacts.splice(index, 1);
            }
        },
        components: {
            appCompanyContact
        },
        created() {
            this.fetchCompanyContacts();
        }
    }
</script>