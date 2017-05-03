<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login | Clinica Médica</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('/public/template/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('/public/template/vendor/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('/public/template/dist/css/sb-admin-2.css') ?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url('/public/template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet') ?>" type="text/css">

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
                            <h3 class="panel-title">Por favor informe o código e a senha</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $this->session->userdata('ERRO'); ?>
                            <form role="form" action="<?php echo base_url('permissao/') ?>" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Código" name="codigo" type="text" autofocus value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                    </div>
                                    <!--                      
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>-->
                                    <input type="hidden" name="tokem" value="<?php echo $tokem ?>" />
                                    <button type="submit" class="btn btn-lg btn-success btn-block" name="login" value="entrar">Login</button>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url('/public/template/vendor/jquery/jquery.min.js') ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('/public/template/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('/public/template/vendor/metisMenu/metisMenu.min.js') ?>"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('/public/template/dist/js/sb-admin-2.js') ?>"></script>

    </body>

</html>