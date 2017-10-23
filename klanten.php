<?php
require_once 'core/init.php';
require_once 'includes/headerLinks.php';
require_once 'includes/navigation.php';

$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
?>
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>R</b>AC</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>RentACar</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Klanten </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="dataTables_wrapper form-inline dt-bootstrap">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_length" id="example1_length"><label>Show
                                                    <select name="example1_length" id="SelectOption" aria-controls="example1" class="form-control input-sm">
                                                        <option value="5">5</option>
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="40">40</option>
                                                        <option value="50">50</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Brand car</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>email</th>
                                        <th>Mobile number</th>
                                        <th>age</th>
                                        <th>Pay method</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                  </table>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                                <ul class="pagination"></ul>
                                            </div>
                                            <a href="klantenAdd.php" class="AddLink">Add a customer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="/RentACar/js/main.js"></script>
<?php require_once 'includes/bottomLinks.php'; ?>