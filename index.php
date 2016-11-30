<?php
include_once 'includes/layout/head.php';
require 'includes/conf/general_parameters.php';
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
if ($_GET[logaut] == '1') {
    session_cache_limiter('nocache,private');
    session_name($sess_name);
    session_start();
    $sid = session_id();
    session_destroy();
}
?>
    <?php
session_start();
session_destroy();
?>
        <div class="form-box" id="login-box">
            <div class="header">FONJUPROF</div>
				<form action="index2.php" id="login-form" class="smart-form client-form" method="post" enctype="multipart/form-data">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="user" class="form-control" placeholder="Usuario"> 
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" class="form-control" placeholder="Contraseña"> 
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <?php if (isset($_GET['error_login'])) {
                $error = $_GET['error_login'];
                ?>
                <div class="callout callout-danger">
                    <p>
                        <?php echo $error_login_ms[$error]; ?>
                    </p>
                </div>
                <?php
                }
                ?>
        </div>
        <div class="col-lg-4"></div>
        <?php
include_once("includes/layout/foot.php");
?>