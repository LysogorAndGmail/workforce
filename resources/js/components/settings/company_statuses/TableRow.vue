<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            {{ company_status.name }}
        </td>
        <td>{{ company_status.org.name }}</td>
        <td><i class="fas fa-circle" :style="{color:company_status.color}"></i></td>
        <td>{{ company_status.reason }}</td>
        <td>
            <span class="float-right">
                <router-link :to="{name: 'settings.company.status.edit', params:{company_status_id:company_status.id}}"
                             tag="a" v-if="permissions.includes('company_status_update')">
                    {{ $t("edit") }}
                </router-link>
                <span v-if="permissions.includes('company_status_destroy') && permissions.includes('company_status_update')">|</span>
                <a href="javascript:void(0)" @click="destroy(company_status.id)"
                   v-if="permissions.includes('company_status_destroy')">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['company_status', 'index'],
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
                axios.delete('/company-status/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompanyStatus', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
