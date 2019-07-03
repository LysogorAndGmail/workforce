<template>
    <div class="tab-content">
        <div class="tab-pane active">
            <h4 class="mt-2 mb-2">{{ $t("add_new_job_title") }}</h4>
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
                <label>{{ $t("category") }} *</label>
                <app-multiselect v-model="selected_category"
                                 data-vv-name="category"
                                 data-vv-as="Category"
                                 v-validate="'required'"
                                 label="name"
                                 :placeholder="$t('choose')"
                                 :selectLabel="$t('press_enter_to_select')"
                                 :deselectLabel="$t('press_enter_to_remove')"
                                 :selectedLabel="$t('selected')"
                                 @update="selectedCategory"
                                 :options="categories"
                                 :allow-empty="false">
                    <template slot="noOptions" slot-scope="props">
                        {{ $t("list_is_empty") }}
                    </template>
                </app-multiselect>
                <span v-show="errors.has('category')" class="help is-danger validation_error" role="alert">
                    <strong>{{ errors.first('category') }}</strong>
                </span>
            </div>
            <div class="form-group">
                <button class="btn btn-secondary" @click="store">{{ $t("save") }}</button>
            </div>
        </div>
    </div>
</template>

<script>
    import appMultiselect from 'vue-multiselect';

    export default {
        data() {
            return {
                form: {},
                categories: [],
                selected_category: []
            };
        },
        methods: {
            store() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.form.category_id = this.selected_category.id;
                        axios.post('/admin/job-title/store', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                            this.$router.push({name: 'admin.settings.job.titles'});
                        }).catch(error => console.log(error));
                    }
                });
            },
            fetchJobTitleCategories() {
                axios.get('/admin/job-title-categories').then(res => {
                    this.categories = res.data;
                }).catch(error => console.log(error));
            },
            selectedCategory(selected) {
                this.selected_category = selected;
            }
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchJobTitleCategories();
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>