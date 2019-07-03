<template>
    <tr>
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
                <router-link v-if="permissions.includes('company_contact_update')"
                             :to="{name: 'company.contact.edit', params:{contact_id:contact.id}}" tag="a">
                    {{ $t("edit") }}
                </router-link><span
                    v-if="permissions.includes('company_contact_update') && permissions.includes('company_contact_destroy')"> | </span>
                <a href="javascript:void(0)" v-if="permissions.includes('company_contact_destroy')"
                   @click="destroy(contact.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['contact', 'index'],
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/company-contact/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompanyContact', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
