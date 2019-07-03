<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>
            <router-link :to="{name: 'company.workschedule.show', params:{workschedule_id:workschedule.id}}" tag="a">
                {{ workschedule.name }}
            </router-link>
        </td>
        <td>
            <span class="float-right">
                <router-link v-if="permissions.includes('workschedule_update')"
                             :to="{name: 'company.workschedule.edit', params:{workschedule_id:workschedule.id}}"
                             tag="a">
                    {{ $t("edit") }}
                </router-link><span
                    v-if="permissions.includes('workschedule_update') && permissions.includes('workschedule_destroy')"> | </span>
                <a href="javascript:void(0)" v-if="permissions.includes('workschedule_destroy')"
                   @click="destroy(workschedule.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['workschedule', 'index'],
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
                axios.delete('/workschedule/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeCompanyWorkschedule', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
