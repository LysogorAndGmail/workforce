<template>
    <section id="content">
        <div class="container">
            <div class="element-header row align-items-center">
                <div class="col-md-auto mr-auto">
                    <h2>Dashboard</h2>
                </div>
                <div class="col-md-auto">
                    <div class="inline-btns">
                        <!--<a href="#" class="btn btn-primary">Some select button</a>-->
                        <!--<a href="#" class="btn btn-secondary">Add New Dashboard</a>-->
                    </div>
                </div>
            </div>
            <div class="element-body">
                <div class="row component-boxes">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="component-box box-white">
                            <div class="component-box-inner has-box-footer">
                                <div class="component-box-header">
                                    <h4>
                                        My Activities
                                        <small>Showing 10 upcoming activities</small>
                                    </h4>
                                </div>
                                <div class="component-box-table">
                                    <table id="activities-compact-table" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th data-orderable="false">Name</th>
                                            <th data-orderable="false">Task description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 02:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 12:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2011-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="alert alert-info alert-dismissable">
                                        <a class="panel-close close" data-dismiss="alert">×</a>
                                        This is an <strong>.alert</strong>. Use this to show messages to the user.
                                    </div>
                                </div>
                                <div class="component-box-footer text-center">
                                    <a href="#" class="btn btn-primary">Show all activities</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="component-box box-white">
                            <div class="component-box-inner has-box-footer">
                                <div class="component-box-header">
                                    <h4>
                                        New Leads
                                        <small>Total records: 77 <span class="small-seperator">|</span> Showing 10
                                            latest
                                        </small>
                                    </h4>
                                </div>
                                <div class="component-box-table">
                                    <table id="leads-table" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Date added</th>
                                            <th data-orderable="false">Company</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        <tr>
                                            <td>2019-01-07</td>
                                            <td>Top Food</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="component-box-footer text-center">
                                    <a href="#" class="btn btn-primary">Show all leads</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="component-box box-white">
                            <div class="component-box-inner has-box-footer">
                                <div class="component-box-header">
                                    <h4>
                                        Small Statistics
                                        <small>Your numbers this month</small>
                                    </h4>
                                </div>
                                <div class="component-box-progress">
                                    <canvas id="doughnut-chart" width="300" height="400"></canvas>
                                </div>
                                <div class="component-box-footer text-center">
                                    <a href="#" class="btn btn-primary">Show more numbers</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="component-box box-white">
                            <div class="component-box-inner">
                                <div class="component-box-header">
                                    <h4>
                                        Dolor sit amet
                                        <small>Charts of interest</small>
                                    </h4>
                                </div>

                                <div class="component-box-progress">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 80%"
                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-center">
                                        <p>Interdum et malesuada fames ac ante ipsum primis in faucibus.<br>Fusce
                                            venenatis dui ut quam finibus, nec efficitur lacus tempus.</p>
                                    </div>
                                </div>

                                <div class="component-box-graph">
                                    <canvas id="pie-chart" width="400" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="component-box box-white">
                            <div class="component-box-inner">
                                <div class="component-box-green">
                                    <div class="row align-items-center">
                                        <div class="col text-right">
                                            <div class="box-green-col-title">Mingi näitaja</div>
                                            <div class="box-green-col-value">+123%</div>
                                            <div class="box-green-col-desc">Keskmine nädala näitaja +72%</div>
                                        </div>
                                        <div class="col text-left">
                                            <div class="box-green-col-title">Veel üks näitaja</div>
                                            <div class="box-green-col-value">+75.7%</div>
                                            <div class="box-green-col-desc">Keskmine kuu näitaja +37.5%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="component-box-graph">
                                    <canvas id="line-chart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="component-box box-white">
                            <div class="component-box-inner has-box-footer">
                                <div class="component-box-header">
                                    <h4>
                                        Recent Files
                                        <small>Total files: 1257 <span class="small-seperator">|</span> Showing 10
                                            latest
                                        </small>
                                    </h4>
                                </div>
                                <div class="component-box-table">
                                    <table id="files-table" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="sorting-disabled" data-orderable="false">File</th>
                                            <th>Size</th>
                                            <th>Modification date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Malefames ac ante ips...</td>
                                            <td>25MB</td>
                                            <td data-order="1">Edited 2 minutes ago</td>
                                        </tr>
                                        <tr>
                                            <td>Curabitar 770</td>
                                            <td>17MB</td>
                                            <td data-order="2">Edited 2 hours ago</td>
                                        </tr>
                                        <tr>
                                            <td>Nuvalo presentation</td>
                                            <td>15MB</td>
                                            <td data-order="3">Edited 20 days ago</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="component-box-footer text-center">
                                    <a href="#" class="btn btn-primary">Show all files</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <ul class="nav nav-tabs nav-tabs-styled d-flex align-items-end responsive" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="activities-tab" data-toggle="tab" href="#activities"
                                   role="tab" aria-controls="activities" aria-selected="true">
                                    <span class="d-flex">
                                        <span class="d-flex-item align-self-center">
                                            <svg width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 fill-rule="evenodd"
                                                 clip-rule="evenodd">
                                                <path d="M3.732 13h1.504s2.32-8.403 2.799-10.263c.156-.605.646-.738.965-.737.319.001.826.224.947.74.581 2.466 3.11 13.908 3.11 13.908s1.597-6.441 1.943-7.891c.101-.425.536-.757 1-.757.464 0 .865.343 1 .707.312.841 1.675 4.287 1.677 4.293h1.591c.346-.598.992-1 1.732-1 1.104 0 2 .896 2 2s-.896 2-2 2c-.741 0-1.388-.404-1.734-1.003-.939-.001-1.856 0-2.266.003-.503.004-.774-.289-.928-.629l-.852-2.128s-1.828 7.367-2.25 8.999c-.153.595-.646.762-.97.758-.324-.004-.847-.198-.976-.783-.549-2.487-2.081-9.369-3.123-14.053 0 0-1.555 5.764-1.936 7.099-.13.454-.431.731-.965.737h-2.268c-.346.598-.992 1-1.732 1-1.104 0-2-.896-2-2s.896-2 2-2c.74 0 1.386.402 1.732 1z"/></svg></span>
                                        <span class="d-flex-item align-self-center hide-mobile">My activities ans tasks</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                                   aria-controls="messages" aria-selected="false">
                                    <span class="d-flex">
                                        <span class="d-flex-item align-self-center"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24"><path
                                                d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 6.817h-18.779l5.513-6.812zm9.208-1.264l4.616-3.741v9.348l-4.616-5.607z"/></svg></span>
                                        <span class="d-flex-item align-self-center hide-mobile">Messages</span>
                                        <span class="d-flex-item align-self-start"><span
                                                class="tab-badge d-flex align-items-center justify-content-center">2</span></span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="branches-tab" data-toggle="tab" href="#branches" role="tab"
                                   aria-controls="branches" aria-selected="false">
                                    <span class="d-flex">
                                        <span class="d-flex-item align-self-center"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24"><path
                                                d="M14 20l-4-4v3h-3c-1.103 0-2-.897-2-2v-10.184c1.163-.413 2-1.511 2-2.816 0-1.657-1.343-3-3-3s-3 1.343-3 3c0 1.305.837 2.403 2 2.816v10.184c0 2.206 1.794 4 4 4h3v3l4-4zm-11.8-16c0-.993.807-1.8 1.8-1.8s1.8.807 1.8 1.8-.807 1.8-1.8 1.8-1.8-.807-1.8-1.8zm7.8 0l4 4v-3h3c1.103 0 2 .897 2 2v10.184c-1.163.413-2 1.512-2 2.816 0 1.657 1.343 3 3 3s3-1.343 3-3c0-1.305-.837-2.403-2-2.816v-10.184c0-2.206-1.794-4-4-4h-3v-3l-4 4zm11.8 16c0 .993-.807 1.8-1.8 1.8s-1.8-.807-1.8-1.8.807-1.8 1.8-1.8 1.8.807 1.8 1.8z"/></svg></span>
                                        <span class="d-flex-item align-self-center hide-mobile">Branches</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contacts" role="tab"
                                   aria-controls="contacts" aria-selected="false">
                                    <span class="d-flex">
                                        <span class="d-flex-item align-self-center"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24"><path
                                                d="M23.995 24h-1.995c0-3.104.119-3.55-1.761-3.986-2.877-.664-5.594-1.291-6.584-3.458-.361-.791-.601-2.095.31-3.814 2.042-3.857 2.554-7.165 1.403-9.076-1.341-2.229-5.413-2.241-6.766.034-1.154 1.937-.635 5.227 1.424 9.025.93 1.712.697 3.02.338 3.815-.982 2.178-3.675 2.799-6.525 3.456-1.964.454-1.839.87-1.839 4.004h-1.995l-.005-1.241c0-2.52.199-3.975 3.178-4.663 3.365-.777 6.688-1.473 5.09-4.418-4.733-8.729-1.35-13.678 3.732-13.678 4.983 0 8.451 4.766 3.732 13.678-1.551 2.928 1.65 3.624 5.09 4.418 2.979.688 3.178 2.143 3.178 4.663l-.005 1.241zm-13.478-6l.91 2h1.164l.92-2h-2.994zm2.995 6l-.704-3h-1.615l-.704 3h3.023z"/></svg></span>
                                        <span class="d-flex-item align-self-center hide-mobile">Contacts</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content responsive">
                            <div class="tab-pane fade show active" id="activities" role="tabpanel"
                                 aria-labelledby="activities-tab">
                                <table id="activities-table" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th data-orderable="false">Name</th>
                                        <th data-orderable="false">Type</th>
                                        <th data-orderable="false">Task description</th>
                                        <th data-orderable="false">Created</th>
                                        <th data-orderable="false">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td data-order="1">2019-01-07 09:00 - 09:00</td>
                                        <td>Boomerang Distribution OÜ</td>
                                        <td>Alert</td>
                                        <td>Call and ask for information regarding cooperation</td>
                                        <td>2018-12-10 by Lauri Voojärv</td>
                                        <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td data-order="2">2019-01-01 09:00 - 09:00</td>
                                        <td>OÜ</td>
                                        <td>Alert</td>
                                        <td>Call and ask for information regarding cooperation</td>
                                        <td>2018-12-10 by Lauri Voojärv</td>
                                        <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td data-order="3">2019-01-06 09:00 - 09:00</td>
                                        <td>Distribution OÜ</td>
                                        <td>Alert</td>
                                        <td>Call and ask for information regarding cooperation</td>
                                        <td>2018-12-10 by Lauri Voojärv</td>
                                        <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td data-order="4">2019-01-06 09:00 - 09:00</td>
                                        <td>Boomerang</td>
                                        <td>Alert</td>
                                        <td>Call and ask for information regarding cooperation</td>
                                        <td>2018-12-10 by Lauri Voojärv</td>
                                        <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                Messages
                            </div>
                            <div class="tab-pane fade" id="branches" role="tabpanel" aria-labelledby="branches-tab">
                                <div class="element-item">
                                    <div class="row folder-grid">
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="folder-grid-item d-flex justify-content-center align-items-center">
                                                <div class="folder-grid-item-inner">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M0 2h8l3 3h10v4h3l-4 13h-20v-20zm22.646 8h-17.907l-3.385 11h17.907l3.385-11zm-2.646-1v-3h-9.414l-3-3h-6.586v15.75l3-9.75h16z"/>
                                                        </svg>
                                                    </div>
                                                    Folder 1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="folder-grid-item d-flex justify-content-center align-items-center">
                                                <div class="folder-grid-item-inner">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M0 2h8l3 3h10v4h3l-4 13h-20v-20zm22.646 8h-17.907l-3.385 11h17.907l3.385-11zm-2.646-1v-3h-9.414l-3-3h-6.586v15.75l3-9.75h16z"/>
                                                        </svg>
                                                    </div>
                                                    Folder 2
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="folder-grid-item d-flex justify-content-center align-items-center">
                                                <div class="folder-grid-item-inner">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M0 2h8l3 3h10v4h3l-4 13h-20v-20zm22.646 8h-17.907l-3.385 11h17.907l3.385-11zm-2.646-1v-3h-9.414l-3-3h-6.586v15.75l3-9.75h16z"/>
                                                        </svg>
                                                    </div>
                                                    Folder 3
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="folder-grid-item d-flex justify-content-center align-items-center">
                                                <div class="folder-grid-item-inner">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M0 2h8l3 3h10v4h3l-4 13h-20v-20zm22.646 8h-17.907l-3.385 11h17.907l3.385-11zm-2.646-1v-3h-9.414l-3-3h-6.586v15.75l3-9.75h16z"/>
                                                        </svg>
                                                    </div>
                                                    Folder 4
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="folder-grid-item d-flex justify-content-center align-items-center">
                                                <div class="folder-grid-item-inner">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M0 2h8l3 3h10v4h3l-4 13h-20v-20zm22.646 8h-17.907l-3.385 11h17.907l3.385-11zm-2.646-1v-3h-9.414l-3-3h-6.586v15.75l3-9.75h16z"/>
                                                        </svg>
                                                    </div>
                                                    Folder 5
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="folder-grid-item d-flex justify-content-center align-items-center">
                                                <div class="folder-grid-item-inner">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                             clip-rule="evenodd">
                                                            <path d="M22 24h-20v-24h14l6 6v18zm-7-23h-12v22h18v-16h-6v-6zm3 15v1h-12v-1h12zm0-3v1h-12v-1h12zm0-3v1h-12v-1h12zm-2-4h4.586l-4.586-4.586v4.586z"/>
                                                        </svg>
                                                    </div>
                                                    Ware07.docx
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-item">
                                    <form>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Email address</label>
                                                    <input type="email" class="form-control"
                                                           id="exampleFormControlInput1" placeholder="name@example.com">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Example select</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Example multiple select</label>
                                            <select multiple class="form-control" id="exampleFormControlSelect2">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Example textarea</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                      rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Example file input</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Check this custom
                                                    checkbox</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="customRadio"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio1">Toggle this
                                                    custom radio</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="customRadio"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio2">Or toggle this
                                                    other custom radio</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Button</button>
                                    </form>
                                </div>
                                <div class="element-item">
                                    <table class="table search-enabled table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th data-orderable="false">Name</th>
                                            <th data-orderable="false">Type</th>
                                            <th data-orderable="false">Task description</th>
                                            <th data-orderable="false">Created</th>
                                            <th data-orderable="false">Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td data-order="1">2019-01-07 09:00 - 09:00</td>
                                            <td>Boomerang Distribution OÜ</td>
                                            <td>Alert</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                            <td>2018-12-10 by Lauri Voojärv</td>
                                            <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td data-order="2">2019-01-01 09:00 - 09:00</td>
                                            <td>OÜ</td>
                                            <td>Alert</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                            <td>2018-12-10 by Lauri Voojärv</td>
                                            <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td data-order="3">2019-01-06 09:00 - 09:00</td>
                                            <td>Distribution OÜ</td>
                                            <td>Alert</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                            <td>2018-12-10 by Lauri Voojärv</td>
                                            <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td data-order="4">2019-01-06 09:00 - 09:00</td>
                                            <td>Boomerang</td>
                                            <td>Alert</td>
                                            <td>Call and ask for information regarding cooperation</td>
                                            <td>2018-12-10 by Lauri Voojärv</td>
                                            <td><a href="#">Edit</a> | <a href="#">Details</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                                Contacts
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>