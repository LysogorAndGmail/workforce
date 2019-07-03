<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ sub_operation.name }}</td>
        <td>{{ sub_operation.operation.name }}</td>
        <td>
            <span class="float-right">
                <router-link
                        :to="{name: 'admin.settings.sub.operation.edit', params:{sub_operation_id:sub_operation.id}}"
                        tag="a">
                    {{ $t("edit") }}
                </router-link> |
                <a href="javascript:void(0)" @click="destroy(sub_operation.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['sub_operation', 'index'],
        methods: {
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }

                axios.delete('/admin/sub-operation/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeSubOperation', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
