<template>
    <div class="container">
        <div class="element-header row align-items-center">
            <div class="col-md-auto mr-auto">
                <h2>{{ $t("users") }}</h2>
            </div>
        </div>
        <div class="element-body">
            <div class="row component-boxes">
                <div class="col-12">
                    <div class="component-box box-white">
                        <div class="component-box-inner">
                            <div class="component-box-profile">
                                <div class="user-profile-layout">
                                    <div class="responsive">
                                        <div class="row mt-2 mb-2">
                                            <div class="col-md-7">
                                                <input type="text" v-model="filter_term" class="form-control"
                                                       :placeholder="$t('filter_by_name')">
                                            </div>
                                            <div class="col-md-5" v-if="permissions.includes('user_create')">
                                                <div class="float-right">
                                                    <router-link :to="{name: 'user.create'}"
                                                                 class="btn btn-secondary"
                                                                 tag="button">
                                                        {{ $t("add_new_user") }}
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ $t("first_name") }}</th>
                                                    <th>{{ $t("last_name") }}</th>
                                                    <th>{{ $t("email") }}</th>
                                                    <th>{{ $t("role") }}</th>
                                                    <th>{{ $t("country") }}</th>
                                                    <th>{{ $t("linked_user") }}</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <app-user v-for="(user, index) in filteredUsers"
                                                               :index="index"
                                                               :user="user"
                                                               :key="user.id"
                                                               @removeUser="removeUser"></app-user>
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
        </div>
    </div>
</template>


<script>
    import appUser from './TableRow';
    import UserService from '@services/user.service';

    export default {
        data() {
            return {
                users: [],
                filter_term: ''
            };
        },
        computed: {
            filteredUsers() {
                return this.users.filter(el => {
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
            fetchUsers() {
                UserService.getUsers().then(users => {
                    this.users = users;
                })
            },
            removeUser(index) {
                this.users.splice(index, 1);
            }
        },
        components: {
            appUser
        },
        created() {
            this.fetchUsers();
        }
    }
</script>
