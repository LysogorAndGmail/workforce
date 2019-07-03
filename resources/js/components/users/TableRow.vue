<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            <router-link :to="{name: 'user.show', params:{user_id:user.id}}" tag="a">
                {{ user.fname }}
            </router-link>
        </td>
        <td>{{ user.lname }}</td>
        <td v-if="user.email">
            <a :href="'mailto:'+user.email">
                {{ user.email }}
            </a>
        </td>
        <td>{{ user.roles[0].display_name }}</td>
        <td v-if="user.country">
            {{ user.country.name }}
        </td>
        <td v-else>-</td>
        <td v-if="user.workforce">
            <router-link :to="{name: 'workforce.show', params:{workforce_id:user.workforce.id}}" tag="a">
                {{ user.workforce.fname+' '+user.workforce.lname }}
            </router-link>
        </td>
        <td v-else>-</td>
        <td>
            <span class="float-right">
                <a v-if="permissions.includes('user_update')" href="javascript:void(0)" @click="edit()">
                    {{ $t("edit") }}
                </a>
                <span v-if="permissions.includes('user_update') && permissions.includes('user_destroy')"> | </span>
                <a v-if="permissions.includes('user_destroy')" href="javascript:void(0)"
                   @click="destroy(user.id)">{{ $t("delete") }}
                </a>
            </span>
        </td>
    </tr>
</template>

<script>

    import UserService from '@services/user.service';

    export default {
        props: ['user', 'index', 'country'],
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            edit() {
                this.$router.push({
                    name: 'user.edit',
                    params: {
                        user_id: this.user.id
                    }
                })
            },
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                UserService.deleteUser(id).then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeUser', this.index);
                }).catch(error => {
                    console.log(error.response.data)
                    this.$toastr.e(this.$t(error.response.data));
                });
            }
        }
    }
</script>
