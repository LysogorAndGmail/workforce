<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ job_title.name }}</td>
        <td>{{ job_title.category.name }}</td>
        <td>
            <span class="float-right">
                <router-link :to="{name: 'admin.settings.job.title.edit', params:{job_title_id:job_title.id}}" tag="a">
                    {{ $t("edit") }}
                </router-link> |
                <a href="javascript:void(0)" @click="destroy(job_title.id)">{{ $t("delete") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['job_title', 'index'],
        methods: {
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }

                axios.delete('/admin/job-title/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeJobTitle', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            }
        }
    }
</script>
