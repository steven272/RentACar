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

            <section class="content-header">
                <h1>
                    Add customer to database
                    <small>RentACar</small>
                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Horizontal Form</h3>
                            </div>
                            <form rol="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name: </label>
                                        <input type="text" class="form-control" id="" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Family name: </label>
                                        <input type="text" class="form-control" id="" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Age: </label>
                                        <input type="text" class="form-control" id="" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pay method: </label>
                                        <input type="text" class="form-control" id="" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile Number</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Choose a car</label>
                                        <select class="form-control">
                                            <option value="">Opel</option>
                                            <option value="">Ferrari</option>
                                            <option value="">Suzuki</option>
                                            <option value="">Mini</option>
                                            <option value="">Porche</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary submit">Save!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>


<?php require_once 'includes/bottomLinks.php'; ?>