<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Disposisi Surat</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="<?php echo base_url('auth/login'); ?>" id="login-form">
                            <fieldset>
                                <?php if ($this->session->flashdata('notif')): ?>
                                    <div class="alert alert-danger" id="alert-danger"><?php echo $this->session->flashdata('notif'); ?></div>
                                <?php endif ?>
                                <div class="alert alert-danger" style="display: none" id="alert-danger"></div>
                                <div class="alert alert-success" style="display: none" id="alert-success">Login berhasil</div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-success btn-block btn-lg" type="submit" onclick="login(event)">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

    <script>
        // delete script ini jika tidak ingin menggunakan ajax
        function login(event) {
            $('#alert-danger').slideUp();
            event.preventDefault();
            $.ajax({
                url: $('#login-form').attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $('#login-form').serialize(),
                success: function(r) {
                    if (r.status) {
                        $('#alert-success').slideDown();
                        $('#alert-danger').slideUp();
                        setTimeout(function() {
                            location.reload(true);
                        },700);
                    } else {
                        $('#alert-danger').html(r.error);
                        $('#alert-danger').slideDown();
                    }
                }
            });
        }
    </script>

</body>

</html>