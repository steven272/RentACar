<?php
session_start();

spl_autoload_register(function($class){
    require_once 'classes/' .$class . '.php';
});

require_once 'functions/sanitize.php';

if(Cookie::exists('hash') && !Session::exists('session_name')) {
    $hash = Cookie::get('hash');
    $hashCheck = DB::getInstance()->get('user_sessions', array('hash', '=', $hash));

    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}
