<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("add_new_category") }}</h4>
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
</template>

<script>
    export default {
        data() {
            return {
                form: {}
            };
        },
        methods: {
            store() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.post('/admin/job-title-category/store', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.$router.push({name: 'admin.settings.job.title.categories'});
                        }).catch(error => console.log(error));
                    }
                });
            }
        }
    }
</script>
