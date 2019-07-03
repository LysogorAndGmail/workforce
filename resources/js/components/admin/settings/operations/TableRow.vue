<template>
    <tr>
        <th>{{ index + 1 }}</th>
        <td v-if="!editing">{{ operation.name }}</td>
        <td v-else>
            <div class="form-group">
                <input type="text"
                       v-model="operation.name"
                       data-vv-name="name"
                       data-vv-as="Name"
                       :class="{'form-control': true, 'is-invalid': errors.has('name') }"
                       v-validate="'required'">
                <span class="invalid-feedback" role="alert" v-show="errors.has('name')">
                    <strong>{{ errors.first('name') }}</strong>
                </span>
            </div>
        </td>
        <td>
            <span class="float-right">
                <a href="javascript:void(0)" @click="edit(operation)" v-if="!editing">{{ $t("edit") }}</a> <span
                    v-if="!editing">|</span>
                <a href="javascript:void(0)" @click="destroy(operation.id)" v-if="!editing">{{ $t("delete") }}</a>
                <a href="javascript:void(0)" @click="cancelEdit(operation)" v-if="editing">{{ $t("cancel") }}</a> <span
                    v-if="editing">|</span>
                <a href="javascript:void(0)" @click="update(operation.id)" v-if="editing">{{ $t("update") }}</a>
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['operation', 'index'],
        data() {
            return {
                editing: false,
                form: {},
                original: {}
            };
        },
        methods: {
            edit(operation) {
                this.form = operation;
                this.original = Object.assign({}, operation);
                this.editing = true;
            },
            cancelEdit(operation) {
                Object.assign(operation, this.original);
                this.form = this.original = null;
                this.editing = false;
            },
            update(id) {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.put('/admin/operation/' + id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.editing = false;
                        });
                    }
                });
            },
            destroy(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }

                axios.delete('/admin/operation/' + id + '/destroy').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                    this.$emit('removeOperation', this.index);
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            },
        }
    }
</script>
