<?php
require_once 'core/init.php';
require_once 'includes/headerLinks.php';
require_once 'includes/navigation.php';

$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
} else {
    $loggedIn = "<section class='content-header'><h1> Welcome " . $user->data()->first_name . " " . $user->data()->last_name . " <small>to your personal dashboad. </small></h1></section>";
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
            <?php  echo $loggedIn; ?>


        </div>
    </div>

<?php require_once 'includes/bottomLinks.php'; ?>