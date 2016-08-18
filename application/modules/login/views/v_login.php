<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login 2</title>

    <link href="<?php echo base_url('assets/admin/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/admin/css/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/style.css')?>" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to IN+</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                	<span><?php echo $captcha_return?></span>
                    <form class="m-t" role="form" method="post" action="<?php echo site_url('login') ?>">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" required="">
                            <?php echo form_error('username'); ?> 
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                            <?php echo form_error('password'); ?> 
                        </div>
                          <div class="textfield">
		                    <h5>Ketik captcha di bawah ini</h5>
		                        <span class="input-group-addon">
		                             <?php echo $cap_img; ?>
		                        </span>
		                      
		                        <input type="text" name="captcha" class="form-control" placeholder="Masukkan Captcha" />
		                        <?php echo form_error('captcha'); ?> 
		                    </div>
                        <input type="submit" name="submit" class="btn btn-primary block full-width m-b" value="Login">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash()  ?>">
                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>
