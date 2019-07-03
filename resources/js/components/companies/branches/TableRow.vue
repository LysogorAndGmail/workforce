<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            <router-link :to="{name: 'company.branche.show', params:{branch_id:branch.id}}" tag="a">
                {{ branch.name }}
            </router-link>
        </td>
        <td>{{ branch.address }}</td>
        <td>{{ branch.phone }}</td>
        <td>{{ branch.email }}</td>
        <td>
            <i class="fas fa-circle" :style="{color:branch.color}"></i>
        </td>
        <td>
            <span class="float-right">
                <router-link v-if="permissions.includes('company_branch_update')"
                             :to="{name: 'company.branche.edit', params:{branch_id:branch.id}}" tag="a">
                    {{ $t("edit") }}
                </router-link><span
                    v-if="permissions.includes('company_branch_update') && permissions.includes('company_branch_destroy')"> | </span>
                <a href="javascript:void(0)" v-if="permissions.includes('company_branch_destroy')"
                   @click="destroy(branch.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['branch', 'index'],
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
                axios.delete('/company-branch/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompanyBranch', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
