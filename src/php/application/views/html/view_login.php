<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("modules/header.php");?>
    </head>
    <body>
		<DIV class="container-fluid">
            <div class="text-center color-white">
                <h1>Welcome to <?php echo $siteName; ?></h1>
                <h2 class="hidden-small">Sign in to continue</h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="<?php echo $appFullPath;?>app/login" method="post" accept-charset="utf-8" role="form">
                                <fieldset>
                                    <div class="row">
                                        <div class="text-center">
                                            <img class="profile-img"
                                                src="<?php echo $baseUrl;?>static/imgs/water-drop-128.png" alt="favicon">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-user"></i>
                                                    </span>
                                                    <input type="email" name="email" placeholder="Email" id="inputEmail" class="form-control input-lg"autofocus >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-lock"></i>
                                                    </span>
                                                    <input type="password" name="password" placeholder="Password" id="inputEmail" class="form-control input-lg">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

