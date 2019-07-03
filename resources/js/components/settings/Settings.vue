<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h2>{{ $t("settings") }}</h2>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12">
                        <div class="component-box box-white">
                            <div class="component-box-inner">
                                <div class="component-box-profile">
                                    <div class="user-profile-layout">
                                        <ul class="nav nav-tabs responsive">
                                            <li class="nav-item" v-if="permissions.includes('role_read')">
                                                <router-link :to="{name: 'settings.roles'}" tag="a" class="nav-link"
                                                             active-class="active">
                                                    {{ $t("roles") }} & {{ $t("permissions") }}
                                                </router-link>
                                            </li>
                                            <li class="nav-item" v-if="permissions.includes('company_status_read')">
                                                <router-link :to="{name: 'settings.company.statuses'}" tag="a"
                                                             class="nav-link"
                                                             active-class="active">
                                                    {{ $t("company_statuses") }}
                                                </router-link>
                                            </li>
                                            <li class="nav-item" v-if="permissions.includes('sales_activity_type_read')">
                                                <router-link :to="{name: 'settings.salesactivitytypes'}" tag="a"
                                                             class="nav-link"
                                                             active-class="active">
                                                    {{ $t("sales_activity_types") }}
                                                </router-link>
                                            </li>
                                        </ul>
                                        <router-view></router-view>
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
    export default {
        computed: {
            permissions() {
                return this.$store.getters.getUserPermissions;
            }
        }
    }
</script>

