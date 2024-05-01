<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
?>

<!-- Header -->
<?php
    require_once (_WEB_PATH_TEMPLATES.'/layout/header.php');
?>

<?php
    require_once (_WEB_PATH.'/modules/user/home.php');
?>
    
<!-- Footer -->

<?php 
    require_once (_WEB_PATH_TEMPLATES.'/layout/footer.php');
?>
       


