<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("edit") }} {{ role.display_name }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $t("name") }} *</label>
                        <input type="text"
                               v-model="role.display_name"
                               data-vv-name="name"
                               data-vv-as="Name"
                               :class="{'form-control': true, 'is-invalid': errors.has('name') }"
                               v-validate="'required'">
                        <span class="invalid-feedback" role="alert" v-show="errors.has('name')">
                            <strong>{{ errors.first('name') }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                form: {},
                role: {},
            };
        },
        methods: {
            fetchRole() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.get('/role/' + this.$route.params.role_id + '/show').then(res => {
                            this.role = res.data;
                        }).catch(error => console.log(error));
                    }
                });
            },
            prepareForm() {
                this.form = {
                    name: this.role.display_name,
                }
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.put('/role/' + this.$route.params.role_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({name: 'settings.roles'});
                        }).catch(error => console.log(error));
                    }
                });
            }
        },
        created() {
            this.fetchRole();
        }
    }
</script>
