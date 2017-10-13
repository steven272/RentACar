<?php require_once 'core/init.php';
require_once 'includes/headerLinks.php';

$global = array();

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate = $validate->check($_POST, array(
            'email' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
            )
        ));

        if ($validate->passed()) {
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('email'), Input::get('password'), $remember);

            if($login) {
                Redirect::to('dashboard.php');
            } else {
                $loginFailed = 'Your e-mail or password is wrong';
                array_push($global, $loginFailed);
            }

        } else {
            $global = $validate->errors();
        }
    }
}
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Rent A Car</b>RAC</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="error"><?php  echo (!empty($global[0])) ? $global[0] : ''; ?></div>
        <form action="#" method="post">
            <div class="form-group has-feedback">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo escape(Input::get('email')); ?>">
                <div class="error"><?php  echo (!empty($global['email'])) ? $global['email'] : ''; ?></div>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <div class="error"><?php  echo (!empty($global['password'])) ? $global['password'] : ''; ?></div>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

        <br>
        <a href="#">I forgot my password</a><br>
        <a href="register.php" class="text-center">Register a new membership</a>

    </div>
</div>


<?php require_once 'includes/bottomLinks.php'; ?>
