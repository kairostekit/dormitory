<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> เข้าสู่ระบบ | <?= APP_NAME ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url('public/') ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('public/') ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('public/') ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('public/') ?>vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url('public/') ?>build/css/custom.min.css" rel="stylesheet">

</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">

                    <div class="alert alert-primary" style=" display: <?= $sError == null ? 'none': "block" ?>; " role="alert">
                        <?= $sError ?>
                    </div>

                    <form action="<?= base_url('Auth/login') ?>" method="post">
                        <h1>เข้าสู่ระบบ</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" name="ACC_USERNAME" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="ACC_PASSWORD" required="" />
                        </div>
                        <div class="justify-content-center">
                            <button type="submit" class="btn btn-md btn-success ">Log in</button>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>


        </div>
    </div>

</body>

</html>