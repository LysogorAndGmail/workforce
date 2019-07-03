<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto mt-2">
                    <h4>{{ $t("edit") }} {{ form.name }}</h4>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="col">
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
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-secondary" @click="update">{{ $t("update") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                form: {}
            };
        },
        methods: {
            fetchCompanyWorkschedule() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.get('/workschedule/' + this.$route.params.workschedule_id + '/show').then(res => {
                            this.form = res.data;
                        }).catch(error => console.log(error));
                    }
                });
            },
            update() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        axios.put('/workschedule/' + this.$route.params.workschedule_id + '/update', this.form).then(res => {
                            this.$toastr.s(this.$t("updated"));
                            this.$router.push({
                                name: 'company.workschedules',
                                params: {company_id: this.$route.params.company_id}
                            });
                        }).catch(error => console.log(error));
                    }
                });
            }
        },
        created() {
            this.fetchCompanyWorkschedule();
        }
    }
</script>
