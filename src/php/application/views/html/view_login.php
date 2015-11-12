<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("modules/header.php");?>
    </head>
    <body>
        <?php include("modules/menu.php");?>
		<div class="container-fluid">
            <div class="text-center color-white">
                <h1>Welcome to <?php echo $siteName; ?></h1>
                <h2 class="hidden-small">Sign in to continue</h2>
            </div>
            <div class="form-box signin-card well">
                <form action="<?php echo $appFullPath;?>app/login" method="post" accept-charset="utf-8" role="form">
                    <?php foreach($login_form_inputs as $form_input):?>
                        <div class="<?php echo $form_input['formGroupClass']; ?>">
                            <?php if(isset($form_input['labelName'])):?>
                                <label for="<?php echo $form_input['id']; ?>"><?php echo $form_input['labelName']; ?></label>
                            <?php endif;?>
                            <input type="<?php echo $form_input['type']; ?>" class="<?php echo $form_input['class']; ?>" id="<?php echo $form_input['id']; ?>" placeholder="<?php echo $form_input['placeholder']; ?>" name="<?php echo $form_input['name']; ?>"/>
                        </div>
                    <?php endforeach;?>
                    <?php if(isset($errors)):?>
                        <?php foreach($errors as $err):?>
                            <div class="alert alert-danger" role="alert"><?php echo $err;?></div>
                        <?php endforeach;?>
                    <?php endif;?>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>

