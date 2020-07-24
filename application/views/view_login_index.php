<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('public') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/dist/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/plugins/iCheck/square/blue.css">
    <style>
        .blogbugabagi {
            background-image: url(<?= base_url('/dist/img/lab-mac.jpg') ?>);
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?= base_url('public') ?>/bower_components/jquery/jquery-3.3.1.min.js"></script>
</head>

<body class="hold-transition login-page blogbugabagi">
    <div class="login-box pt-5">
        <!-- /.login-logo -->
        <div class="login-box-body">
            <center>
                <a href="https://blogbugabagi.blogspot.com" target="_blank" rel="noopener noreferrer">
                    <img src="<?= base_url('/dist/img/b.png') ?>" width="30%" alt="" srcset="">
            </center>
            <h3 class="text-center mt-0 mb-4">
                <b>C</b>omputer <b>B</b>ased <b>T</b>est
            </h3> </a>
            <p class="login-box-msg">Masukan akun anda</p>

            <div id="infoMessage" class="text-center"><?php echo $message; ?></div>

            <?= form_open("auth/cek_login", array('id' => 'login')); ?>
            <div class="form-group has-feedback">
                <?= form_input($identity); ?>
                <span class="fa fa-envelope form-control-feedback"></span>
                <span class="help-block"></span>
            </div>
            <div class="form-group has-feedback">
                <?= form_input($password); ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="help-block"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <?= form_checkbox('remember', '', FALSE, 'id="remember"'); ?> Ingat saya
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= form_submit('submit', lang('login_submit_btn'), array('id' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat')); ?>
                </div>
                <!-- /.col -->
            </div>
            <?= form_close(); ?>

            <a href="<?= base_url('public') ?>auth/forgot_password" class="text-center"><?= lang('login_forgot_password'); ?></a>

        </div>
    </div>

    <script type="text/javascript">
        let base_url = '<?= base_url('public'); ?>';
    </script>
    <script src="<?= base_url('public') ?>/dist/js/app/auth/login.js"></script>
    <script src="<?= base_url('public') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('public') ?>/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>