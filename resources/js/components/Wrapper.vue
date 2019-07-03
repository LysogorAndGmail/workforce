<template>
    <div id="wrapper">
        <app-header></app-header>
        <app-nav></app-nav>
        <!--<app-breadcrums></app-breadcrums>-->
        <router-view></router-view>
    </div>
</template>

<script>
    import appHeader from './layout/Header';
    import appNav from './layout/Nav';
    import appBreadcrums from './layout/Breadcrums';

    export default {
        components: {
            appNav,
            appHeader,
            appBreadcrums
        }
    }
</script>
