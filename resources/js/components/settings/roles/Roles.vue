<template>
    <td><span v-if="permissions.includes('role_update')">
            <toggle-button
                    :value="permissionIds(role.permissions).includes(permission.id)  ? true : false"
                    :width="50"
                    class="filter-button"
                    :color="{checked: '#5ec58c', unchecked: '#bec7dd'}"
                    :labels="{checked: $t('yes'), unchecked: $t('no')}"
                    @change="togglePermission(role.id, permission.id)"
                    :ref="'toggle_'+role.id+'_'+permission.id"/>
        </span>
    </td>
</template>

<script>
    export default {
        props: ['role', 'permission'],
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            permissionIds(permissions) {
                return permissions.map(o => o['id']);
            },
            togglePermission(roleId, permissionId) {
                let ref = 'toggle_' + roleId + '_' + permissionId;
                axios.get('/role/' + roleId + '/permission/' + permissionId + '/toggle-permission').then(res => {
                    this.$toastr.s(this.$t(res.data.message));
                }).catch(error => {
                    this.$refs[ref].toggled = true;
                    this.$toastr.e(this.$t(error.response.data.message));
                });
            },
        }
    }
</script>
