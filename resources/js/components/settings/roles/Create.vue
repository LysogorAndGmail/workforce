<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("add_new_role") }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $t("name") }} *</label>
                        <input type="text"
                               v-model="form.name"
                               data-vv-name="name"
                               data-vv-as="Name"
                               :class="{'form-control': true, 'is-invalid': errors.has('name') }"
                               v-validate="'required'">
                        <span class="invalid-feedback" role="alert" v-show="errors.has('name')">
                            <strong>{{ errors.first('name') }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary" @click="store">{{ $t("save") }}</button>
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
            };
        },
        methods: {
            store() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.post('/role/store', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.$router.push({name: 'settings.roles'});
                        }).catch(error => console.log(error));
                    }
                });
            }
        }
    }
</script>
