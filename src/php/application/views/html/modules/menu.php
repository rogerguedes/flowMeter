<?php if(isset($sessionUser)):?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbarLogoAnchor" href="<?php echo $baseUrl;?>"><img src="<?php echo $baseUrl;?>static/imgs/logo.png" /></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="capitalize" href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo($sessionUser->getName());?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $appFullPath;?>app/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<?php endif;?>
