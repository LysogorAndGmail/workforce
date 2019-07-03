import VueRouter from 'vue-router';

let routes = [
    {path: '/', component: require('./components/Dashboard').default, name: 'dashboard'},
    {
        path: '/admin/settings', component: require('./components/admin/settings/Settings').default,
        children: [
            {path: 'job-title-categories', component: require('./components/admin/settings/job_title_categories/JobTitleCategories').default, name: 'admin.settings.job.title.categories'},
            {path: 'job-title-categories/create', component: require('./components/admin/settings/job_title_categories/Create').default, name: 'admin.settings.job.title.categories.create'},
            {path: 'job-titles', component: require('./components/admin/settings/job_titles/JobTitles').default, name: 'admin.settings.job.titles'},
            {path: 'job-title/create', component: require('./components/admin/settings/job_titles/Create').default, name: 'admin.settings.job.title.create'},
            {path: 'job-title/:job_title_id/edit', component: require('./components/admin/settings/job_titles/Edit').default, name: 'admin.settings.job.title.edit'},
            {path: 'operations', component: require('./components/admin/settings/operations/Operations').default, name: 'admin.settings.operations'},
            {path: 'operations/create', component: require('./components/admin/settings/operations/Create').default, name: 'admin.settings.operations.create'},
            {path: 'sub-operations', component: require('./components/admin/settings/sub_operations/SubOperations').default, name: 'admin.settings.sub.operations'},
            {path: 'sub-operations/create', component: require('./components/admin/settings/sub_operations/Create').default, name: 'admin.settings.sub.operation.create'},
            {path: 'sub-operations/:sub_operation_id/edit', component: require('./components/admin/settings/sub_operations/Edit').default, name: 'admin.settings.sub.operation.edit'},
        ]
    },
    {path: '/companies', component: require('./components/companies/Companies').default, name: 'companies'},
    {path: '/company/create', component: require('./components/companies/Create').default, name: 'company.create'},
    {
        path: '/company/:company_id', component: require('./components/companies/Show').default,
        children: [
            {path: 'branches', component: require('./components/companies/branches/Branches').default, name: 'company.branches'},
            {path: 'branche/create', component: require('./components/companies/branches/Create').default, name: 'company.branche.create'},
            {path: 'branche/:branch_id/show', component: require('./components/companies/branches/Show').default, name: 'company.branche.show'},
            {path: 'branche/:branch_id/edit', component: require('./components/companies/branches/Edit').default, name: 'company.branche.edit'},

            {path: 'contacts', component: require('./components/companies/contacts/Contacts').default, name: 'company.contacts'},
            {path: 'contact/create', component: require('./components/companies/contacts/Create').default, name: 'company.contact.create'},
            {path: 'contact/:contact_id/edit', component: require('./components/companies/contacts/Edit').default, name: 'company.contact.edit'},

            {path: 'docs', component: require('./components/companies/docs/Docs').default, name: 'company.docs'},

            {path: 'doc-folder/:folder_id/show', component: require('./components/companies/docs/ShowFolder').default, name: 'company.docs.docfolder.show'},

            {path: 'workschedules', component: require('./components/companies/workschedules/Workschedules').default, name: 'company.workschedules'},
            {path: 'workschedule/create', component: require('./components/companies/workschedules/Create').default, name: 'company.workschedule.create'},
            {path: 'workschedule/:workschedule_id/edit', component: require('./components/companies/workschedules/Edit').default, name: 'company.workschedule.edit'},
        ]
    },

    {path: '/workschedule/:workschedule_id/show', component: require('./components/companies/workschedules/Show').default, name: 'company.workschedule.show'},

    {path: '/company/:company_id/edit', component: require('./components/companies/Edit').default, name: 'company.edit'},

    {path: '/workforces', component: require('./components/workforce/Workforce').default, name: 'workforces'},
    {path: '/workforce/create', component: require('./components/workforce/Create').default, name: 'workforce.create'},
    {path: '/workforce/:workforce_id/show', component: require('./components/workforce/Show').default, name: 'workforce.show'},
    {path: '/workforce/:workforce_id/edit', component: require('./components/workforce/Edit').default, name: 'workforce.edit'},

    {path: '/users', component: require('./components/users/Users').default, name: 'users'},
    {path: '/user/create', component: require('./components/users/Create').default, name: 'user.create'},
    {path: '/user/:user_id/show', component: require('./components/users/Show').default, name: 'user.show'},
    {path: '/user/:user_id/edit', component: require('./components/users/Edit').default, name: 'user.edit'},

    {
        path: '/settings', component: require('./components/settings/Settings').default,
        children: [
            {path: 'roles', component: require('./components/settings/roles/RolesAndPermissions').default, name: 'settings.roles'},
            {path: 'role/create', component: require('./components/settings/roles/Create').default, name: 'settings.role.create'},
            {path: 'role/:role_id/edit', component: require('./components/settings/roles/Edit').default, name: 'settings.role.edit'},
            {path: 'company-statuses', component: require('./components/settings/company_statuses/CompanyStatuses').default, name: 'settings.company.statuses'},
            {path: 'company-status/create', component: require('./components/settings/company_statuses/Create').default, name: 'settings.company.status.create'},
            {path: 'company-status/:company_status_id/edit', component: require('./components/settings/company_statuses/Edit').default, name: 'settings.company.status.edit'},
            {path: 'sales-activity-types', component: require('./components/settings/sales_activity_types/SalesActivityTypes').default, name: 'settings.salesactivitytypes'},
            {path: 'sales-activity-type/create', component: require('./components/settings/sales_activity_types/Create').default, name: 'settings.salesactivitytype.create'},
            {path: 'sales-activity-type/:sales_activity_type_id/edit', component: require('./components/settings/sales_activity_types/Edit').default, name: 'settings.salesactivitytype.edit'},
        ]
    },

    {path: '*', redirect: '/'}
];

const router = new VueRouter({
    routes,
    linkActiveClass: 'current-menu-item'
});

export default router;
