<template>
    <tr>
        <td>{{ $t(permission.name) }}</td>
        <app-roles v-for="(role, indexrole) in roles"
                   :role="role"
                   :permission="permission"
                   :key="role.id"></app-roles>
    </tr>
</template>
<script>
    import appRoles from './Roles';

    export default {
        props: ['permission', 'index', 'roles'],
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        components: {
            appRoles
        }
    }
</script>
