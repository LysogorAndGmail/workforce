<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            <router-link :to="{name: 'workforce.show', params:{workforce_id:workforce.id}}" tag="a">

                {{ workforce.fname }}
            </router-link>
        </td>
        <td>{{ workforce.lname }}</td>
        <td>{{ workforce.job_titles.name }}</td>
        <td>{{ workforce.organization.name }}</td>
        <td v-if="workforce.gender == 0">
            {{ $t("male") }}
        </td>
        <td v-else>{{ $t("female") }}</td>
        <td>{{ workforce.dob | formatDate }}</td>
        <td v-if="workforce.is_personnel == 1">
            {{ $t("personnel") }}
        </td>
        <td v-else>-</td>
        <td>{{ workforce.phone }}</td>
        <td v-if="workforce.email">
            <a :href="'mailto:'+workforce.email">
                {{ workforce.email }}
            </a>
        </td>
        <td>
            <span class="float-right">
                <a v-if="permissions.includes('workforce_update')" href="javascript:void(0)" @click="edit()">{{ $t("edit") }}</a><span
                    v-if="permissions.includes('workforce_update') && permissions.includes('workforce_destroy')"> | </span>
                <a v-if="permissions.includes('workforce_destroy')" href="javascript:void(0)"
                   @click="destroy(workforce.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['workforce', 'index'],
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            edit() {
                this.$router.push({
                    name: 'workforce.edit',
                    params: {
                        workforce_id: this.workforce.id
                    }
                })
            },
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/workforce/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeWorkforce', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
