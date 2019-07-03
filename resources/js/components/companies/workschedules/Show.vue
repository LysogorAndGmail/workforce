<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h1>{{ workschedule.name }}</h1>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="component-box box-white">
                            <div class="component-box-inner">
                                <div class="component-box-calendar">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <span class="btn btn-info" style="min-width: 1rem;"
                                                          @click="currentMonth">{{ $t('today') }}</span>
                                                </div>
                                                <div class="col-md-1 arrow-block">
                                                    <button class="btn btn-outline-info float-left"
                                                            style="min-width: 1rem;" @click="previousMonth">
                                                        <
                                                    </button>
                                                    <button class="btn btn-outline-info float-right"
                                                            style="min-width: 1rem;" @click="nextMonth">
                                                        >
                                                    </button>
                                                </div>

                                                <div class="col-md-2 schedule-main-date">
                                                    {{ today | formatDate }}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="calendar-title text-center">{{ today | formatMonth }}</h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <router-link
                                                    :to="{name: 'company.workschedules', params:{company_id: workschedule.company_id}}"
                                                    tag="button" class="btn btn-warning btn-small">
                                                {{ company.name }}
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" v-model="filter_term" class="form-control"
                                                   :placeholder="$t('filter_by_name')">
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <button class="btn btn-success btn-small" @click="showWorkforceModal()"
                                                    v-if="permissions.includes('workschedule_workforces_create')">
                                                {{ $t('add_new_workforce') }}
                                            </button>
                                            <modal name="add_new_worker">
                                                <div class="col-md-12 p-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>{{ $t("workforce") }} *</label>
                                                                <app-multiselect v-model="selected_workforces"
                                                                                 label="full_name"
                                                                                 data-vv-name="workforce"
                                                                                 data-vv-as="Workforce"
                                                                                 v-validate="'required'"
                                                                                 :placeholder="$t('choose')"
                                                                                 :selectLabel="$t('press_enter_to_select')"
                                                                                 :deselectLabel="$t('press_enter_to_remove')"
                                                                                 :selectedLabel="$t('selected')"
                                                                                 autocomplete="off"
                                                                                 :multiple="true"
                                                                                 :options="workforces"
                                                                                 track-by="full_name">
                                                                <template slot="noOptions" slot-scope="props">
                                                                    {{ $t("list_is_empty") }}
                                                                </template>
                                                                </app-multiselect>
                                                                <span v-show="errors.has('workforce')"
                                                                      class="help is-danger validation_error"
                                                                      role="alert">
                                                                        <strong>{{ errors.first('workforce') }}</strong>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 text-center pt-3">
                                                                <button class="btn btn-secondary"
                                                                        @click="saveWorkforce">{{
                                                                    $t("save") }}
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </modal>
                                        </div>
                                    </div>
                                    <div class="calendar-body">
                                        <table class="table table-bordered table-striped table-default table-calendar">
                                            <thead>
                                            <tr>
                                                <th>
                                                    {{ $t("name") }}
                                                </th>
                                                <th v-for="day in month_days" class="text-center">
                                                    {{ day }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="schedule_workforce in filteredWorkforce">
                                                <th>
                                                    <a>
                                                        <div class="btn-group">
                                                           <span v-if="permissions.includes('workschedule_workforces_destroy')"
                                                                 :id="'dropdown'+schedule_workforce.id"
                                                                 data-toggle="dropdown"
                                                                 aria-expanded="false">
                                                               <a class="user-edit">
                                                                   <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24"
                                                                        height="24"
                                                                        viewBox="0 0 24 24"><path
                                                                           d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"/></svg>
                                                               </a>
                                                           </span>
                                                            <div class="dropdown-menu dropdown-menu-left"
                                                                 :aria-labelledby="'dropdown'+schedule_workforce.id">
                                                                <a href="javascript:void(0)" class="dropdown-item"
                                                                   @click="destroyWorkforce(schedule_workforce.id)">
                                                                    {{ $t("delete") }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        {{ schedule_workforce.fname + " " +schedule_workforce.lname }}
                                                    </a>
                                                </th>
                                                <td v-for="day in month_days" class="text-center">

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import appMultiselect from 'vue-multiselect';
    import moment from 'moment';

    export default {
        data() {
            return {
                workschedule: {},
                schedule_workforces: [],
                form: {},
                company: {},
                workforces: [],
                selected_workforces: [],
                filter_term: '',
                today: moment(),
                month_days: 0
            }
        },
        computed: {
            filteredWorkforce() {
                return this.schedule_workforces.filter(el => {
                    if (!el.fname) {
                        return false;
                    }
                    return (el.fname).toLowerCase().match((this.filter_term).toLowerCase());
                });
            },
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        },
        methods: {
            previousMonth() {
                this.today = moment(this.today).subtract(1, 'month');
                this.monthDays();
            },
            nextMonth() {
                this.today = moment(this.today).add(1, 'month');
                this.monthDays();
            },
            currentMonth() {
                this.today = moment();
                this.monthDays();
            },
            monthDays() {
                this.month_days = moment(this.today).daysInMonth();
            },
            prepareForm() {
                let workforces = [];
                this.selected_workforces.filter(el => {
                    workforces.push(el.id);
                });
                this.form = {
                    workforces: workforces,
                    work_schedule_id: this.$route.params.workschedule_id,
                }
            },
            saveWorkforce() {
                this.$validator.validate().then(isValid => {
                    if (isValid) {
                        this.prepareForm();
                        axios.post('/schedule/add-workforce', this.form).then(res => {
                            this.$toastr.s(this.$t("saved"));
                        }).then(res => {
                            this.hideWorkforceModal();
                            this.fetchScheduleWorkforces();
                            this.fetchWorkforces();
                            this.selected_workforces = [];
                        }).catch(error => this.$toastr.e(this.$t(error.response.data.message)));
                    }
                });
            },
            destroyWorkforce(id) {
                if (!window.confirm(this.$t("delete") + '?')) {
                    return false;
                }
                axios.delete('/schedule/' + this.$route.params.workschedule_id + '/' + id + '/destroy-workforce').then(res => {
                    this.$toastr.s(this.$t("deleted"));
                }).then(res => {
                    this.fetchScheduleWorkforces();
                    this.fetchWorkforces();
                }).catch(error => {
                    this.$toastr.e(this.$t(error.response.data.message));
                });
            },
            fetchCompanyWorkschedule() {
                axios.get('/workschedule/' + this.$route.params.workschedule_id + '/show').then(res => {
                    this.workschedule = res.data;
                    this.company = res.data.company;
                }).catch(error => console.log(error));
            },
            fetchScheduleWorkforces() {
                axios.get('/schedule/' + this.$route.params.workschedule_id + '/workforces').then(res => {
                    this.schedule_workforces = res.data[0].workforces;
                }).catch(error => console.log(error));
            },
            fetchWorkforces() {
                axios.get('/workforces/only-workforce').then(res => {
                    let filtered_workforces = [];
                    res.data.filter(res_el => {
                        if (!this.checkWorkforce(res_el)) {
                            filtered_workforces.push(res_el);
                        }
                    });
                    this.workforces = filtered_workforces;
                }).catch(error => console.log(error));
            },
            checkWorkforce(workforce) {
                let check = false;
                this.schedule_workforces.filter(el => {
                    if (el.id == workforce.id) {
                        check = true;
                    }
                })
                return check;
            },
            showWorkforceModal() {
                this.$modal.show('add_new_worker');
            },
            hideWorkforceModal() {
                this.$modal.hide('add_new_worker');
            },
            hideModalUpdate() {
                this.$modal.hide('update_new_worker');
            }
        },
        components: {
            appMultiselect
        },
        created() {
            this.fetchCompanyWorkschedule();
            this.fetchScheduleWorkforces();
            this.fetchWorkforces();
            this.monthDays();
        }
    }
</script>
