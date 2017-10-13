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
                                    <?php
                                    $dataTable = new Datatable();
                                    $dataTable->getDataTable('customers', 'cars', array(
                                            'cars' => array(
                                                    'type_car',
                                            ),
                                            'customers' => array(
                                                    'first_name',
                                                    'last_name',
                                                    'age',
                                                    'email',
                                                    'mobile_number',
                                                    'pay_method',
                                                    'car_id',
                                            ),
                                    ));

                                    foreach ($dataTable->data() as $result => $items) {
                                        echo '<tr>';
                                            foreach ($items as $item => $key) {
                                                echo '<td>' . $key . '</td>';
                                            }
                                        echo '<tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php require_once 'includes/bottomLinks.php'; ?>