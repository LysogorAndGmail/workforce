<template>
    <header id="header">
        <div class="container">
            <div class="row align-items-center">
                <div id="header-logo" class="col-12 col-md-3 col-lg-2">
                    <router-link :to="{name: 'dashboard'}" tag="a">
                        WorkForce
                    </router-link>
                </div>
                <div class="col-12 col-md-9 col-lg-10">
                    <div id="header-items" :class="{ active: header_toggle }">
                        <div class="header-items-inner" :class="{ active: checkToggle }">
                            <div class="row align-items-center">
                                <div id="header-icons" class="col-md-auto">
                                    <ul class="inline-icons">
                                        <li>
                                            <a href="#" class="inline-icon">
                                                <span class="inline-icon-badge badge-left">1</span>
                                                <span class="inline-icon-badge badge-right">10</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24">
                                                    <path d="M15.137 3.945c-.644-.374-1.042-1.07-1.041-1.82v-.003c.001-1.172-.938-2.122-2.096-2.122s-2.097.95-2.097 2.122v.003c.001.751-.396 1.446-1.041 1.82-4.667 2.712-1.985 11.715-6.862 13.306v1.749h20v-1.749c-4.877-1.591-2.195-10.594-6.863-13.306zm-3.137-2.945c.552 0 1 .449 1 1 0 .552-.448 1-1 1s-1-.448-1-1c0-.551.448-1 1-1zm3 20c0 1.598-1.392 3-2.971 3s-3.029-1.402-3.029-3h6z"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="inline-icon">
                                                <span class="inline-icon-badge badge-right">1</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24">
                                                    <path d="M12 12.713l-11.985-9.713h23.971l-11.986 9.713zm-5.425-1.822l-6.575-5.329v12.501l6.575-7.172zm10.85 0l6.575 7.172v-12.501l-6.575 5.329zm-1.557 1.261l-3.868 3.135-3.868-3.135-8.11 8.848h23.956l-8.11-8.848z"/>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div id="header-search" class="col-md-auto mr-auto">
                                    <form class="search">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control">
                                                <div class="input-group-append">
                                                    <button type="button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="header-actions" class="col-md-auto">
                                    <div class="row no-gutters align-items-center">
                                        <!--language-->
                                        <div class="col-md-auto btn-group-small">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle" type="button" id="dropdownMenu1"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <span v-for="(lang, i) in langs" v-if="lang.abbr == session_lang">{{ lang.name }}</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu1">
                                                    <a href="javascript:void(0)" class="dropdown-item"
                                                       @click="changeLang(lang.abbr),headerToggle()"
                                                       v-for="(lang, i) in langs">
                                                        {{ lang.name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--role-->
                                        <div class="col-md-auto btn-group-small">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle" type="button" id="roleDrop"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <span v-for="(role, i) in roles" v-if="role.id == session_role">{{ role.display_name }}</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="roleDrop">
                                                    <a href="javascript:void(0)" class="dropdown-item"
                                                       @click="changeRole(role.id),headerToggle()"
                                                       v-for="(role, i) in roles">
                                                        {{ role.display_name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--organization-->
                                        <div class="col-md-auto btn-group-small">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle" type="button" id="orgDrop"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <span v-for="(org, i) in orgs" v-if="org.id == session_org">
                                                        {{ org.name }}
                                                    </span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="orgDrop">
                                                    <a href="javascript:void(0)" class="dropdown-item"
                                                       @click="changeOrg(org.id),headerToggle()"
                                                       v-for="(org, i) in orgs">
                                                        {{ org.name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--user-->
                                        <div class="col-md-auto btn-group-user">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle" type="button" id="dropdownMenu4"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <img src="assets/img/user-small.jpg" class="round-image">
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu4">
                                                    <a class="dropdown-item" href="javascript:void(0)" @click="loginToAccount">
                                                        Account
                                                    </a>
                                                    <a class="dropdown-item" href="/logout"
                                                       onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                                        Log out
                                                    </a>
                                                    <form id="logout-form" action="/logout" method="POST"
                                                          style="display: none;">
                                                        <input type="hidden" name="_token" :value="csrf">
                                                    </form>
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
        </div>
        <button id="header-toggle" @click="headerToggle" type="button">
            <span class="menui top-menu" :class="{ animate: header_toggle }"></span>
            <span class="menui mid-menu" :class="{ animate: header_toggle }"></span>
            <span class="menui bot-menu" :class="{ animate: header_toggle }"></span>
        </button>
        <button id="mobile-toggle" @click="mobileToggle" type="button">
            <span class="menui top-menu" :class="{ animate: mobile_toggle }"></span>
            <span class="menui mid-menu" :class="{ animate: mobile_toggle }"></span>
            <span class="menui bot-menu" :class="{ animate: mobile_toggle }"></span>
        </button>
    </header>
</template>

<script>
    import langs from '../../lang/lang_change';
    
    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                selected_org: null,
                session_org: null,
                selected_role: null,
                session_role: null,
                session_lang: 'en',
                langs: langs,
                header_toggle: false,
                mobile_toggle: false,
            };
        },
        computed: {
            roles() {
                return this.$store.getters.getUserRoles;
            },
            orgs() {
                return this.$store.getters.getUserOrgs;
            },
            fullName() {
                return this.$store.getters.getUserFullname;
            },
            checkToggle() {
                EventBus.$on('mobile_toggle', mobile_toggle => {
                    this.mobile_toggle = mobile_toggle;
                });
            }
        },
        methods: {
            loginToAccount(){
                axios.get('/login-to-account').then(res => {
                    window.location.href = res.data.url;
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            },
            changeLang(lang) {
                this.session_lang = lang;
                this.$i18n.locale = lang;
                axios.get('/lang/' + lang);
            },
            sessionLang(lang) {
                axios.get('/session-lang').then(res => {
                    this.session_lang = res.data;
                    this.$i18n.locale = res.data;
                });
            },
            fetchAuthUser() {
                return this.$store.dispatch('fetchAuthUser');
            },
            fetchUserOrgs() {
                return this.$store.dispatch('fetchUserOrgs');
            },
            fetchUserRoles() {
                return this.$store.dispatch('fetchUserRoles');
            },
            changeOrg(id) {
                this.selected_org = id;
                axios.get('/change-org/' + this.selected_org).then(res => {
                    this.fetchSessionOrg();
                }).then(() => {
                    this.fetchUserRoles();
                    this.fetchSessionRole();
                    this.fetchUserPermissions();
                    this.$router.push({name: 'dashboard'});
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            },
            changeRole(id) {
                this.selected_role = id;
                axios.get('/change-role/' + this.selected_role).then(res => {
                    this.fetchSessionRole();
                    this.fetchUserPermissions();
                    this.$router.push({name: 'dashboard'});
                }).catch(error => {
                    this.$toastr.e(error.response.data.message);
                });
            },
            fetchSessionOrg() {
                axios.get('/session-org').then(res => {
                    this.selected_org = res.data;
                    this.session_org = res.data;
                }).catch(error => console.log(error));
            },
            fetchSessionRole() {
                axios.get('/session-role').then(res => {
                    this.selected_role = res.data;
                    this.session_role = res.data;
                }).catch(error => console.log(error));
            },
            fetchUserPermissions() {
                return this.$store.dispatch('fetchUserPermissions');
            },
            headerToggle() {
                if (!this.header_toggle) {
                    this.header_toggle = true;
                    this.mobile_toggle = false;
                    this.showMobile(this.mobile_toggle);
                } else {
                    this.header_toggle = false;
                }
            },
            mobileToggle() {

                if (!this.mobile_toggle) {
                    this.mobile_toggle = true;
                    this.header_toggle = false;
                } else {
                    this.mobile_toggle = false;
                }

                this.showMobile(this.mobile_toggle);

            },
            showMobile(toggle) {
                EventBus.$emit('mobile_toggle', toggle);
            }
        },
        created() {
            this.fetchSessionRole();
            this.fetchSessionOrg();
            this.fetchAuthUser();
            this.fetchUserOrgs();
            this.fetchUserPermissions();
            this.sessionLang();
        }
    }
</script>

<style scoped>
    .active {
        display: block !important;
    }
</style>