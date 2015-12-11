<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("modules/header.php");?>
        <script src="<?php echo $baseUrl; ?>/static/js/readings.js"></script>
    </head>
    <body>
        <?php include("modules/menu.php");?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix text-center">
                            <span class="panel-title">Leituras</span>
                        </div>
                        <div class="panel-body">
                            <div id="readingsDiv" class="table-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
