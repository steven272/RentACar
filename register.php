<?php
require_once 'core/init.php';
require_once 'includes/headerLinks.php';

$global = array();
$passed = '';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate = $validate->check($_POST, array(
            'firstName' => array(
                'required' => true,
                'min' => 2,
                'max' => 65,
            ),
            'lastName' => array(
                'required' => true,
                'min' => 2,
                'max' => 65,
            ),
            'mobileNumber' => array(
                'required' => true,
                'min' => 9,
                'max' => 65,
            ),
            'email' => array(
                'required' => true,
                'max' => 255,
                'email' => true,
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'passwordAgain' => array(
                'required' => true,
                'matches' => 'password'
            )
        ));

        if ($validate->passed()) {
            $user = new User();
            $salt = Hash::salt(32);

            try {
                $user->create(array(
                    'user_group_id' => 1,
                    'first_name' => Input::get('firstName'),
                    'last_name' => Input::get('lastName'),
                    'mobile_number' => Input::get('mobileNumber'),
                    'email' => Input::get('email'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt
                ));

                $passed = 'user has been registered';
            } catch (Exception $e) {
                die($e->getMessage());
            }

        } else {
            $global = $validate->errors();
        }
    }
}
?>
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Rent A Car</b>RAC</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new user</p>
            <div class="passed"><?php  echo (!empty($passed)) ? $passed : ''; ?></div>
            <form action="" id="registration-form" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo escape(Input::get('firstName')); ?>" autocomplete="off" placeholder="First Name">
                    <div class="error"><?php  echo (!empty($global['firstName'])) ? $global['firstName'] : ''; ?></div>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo escape(Input::get('lastName')); ?>" placeholder="Last Name">
                    <div class="error"><?php  echo (!empty($global['lastName'])) ? $global['lastName'] : ''; ?></div>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="mobileNumber" id="mobileNumber" value="<?php echo escape(Input::get('mobileNumber')); ?>" placeholder="Mobile number">
                    <div class="error"><?php  echo (!empty($global['mobileNumber'])) ? $global['mobileNumber'] : ''; ?></div>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" placeholder="Email">
                    <div class="error"><?php  echo (!empty($global['email'])) ? $global['email'] : ''; ?></div>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <div class="error"><?php  echo (!empty($global['password'])) ? $global['password'] : ''; ?></div>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="passwordAgain" id="passwordAgain" placeholder="Retype password">
                    <div class="error"><?php  echo (!empty($global['passwordAgain'])) ? $global['passwordAgain'] : ''; ?></div>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" id="submit-btn" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                </div>
                <div class="error"></div>
            </form>

            <br>
            <a href="login.php" class="text-center">I already have a membership</a>
        </div>
    </div>


<?php require_once 'includes/bottomLinks.php'; ?>

