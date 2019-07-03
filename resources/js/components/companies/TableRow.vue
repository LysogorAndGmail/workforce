<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            <router-link :to="{name: 'company.contacts', params:{company_id:company.id}}" tag="a">
                {{ company.name }}
            </router-link>
        </td>
        <td>
            <i class="fas fa-circle" :style="{color:company.status.color}"></i>
            {{ company.status.name }}
        </td>
        <td>{{ company.reg }}</td>
        <td>{{ company.address }}</td>
        <td v-if="company.website">
            <a :href="'http://'+company.website" target="_blank">{{ company.website }}</a>
        </td>
        <td v-else>-</td>
        <td>{{ company.phone }}</td>
        <td v-if="company.email">
            <a :href="'mailto:'+company.email">{{ company.email }}</a>
        </td>
        <td v-else>-</td>
        <td>
            <span class="float-right">
                <router-link v-if="permissions.includes('company_update')"
                             :to="{name: 'company.edit', params:{company_id:company.id}}" tag="a">
                    {{ $t("edit") }}
                </router-link><span
                    v-if="permissions.includes('company_update') && permissions.includes('company_destroy')"> | </span>
                <a href="javascript:void(0)" v-if="permissions.includes('company_destroy')"
                   @click="destroy(company.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['company', 'index'],
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
                axios.delete('/company/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompany', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
