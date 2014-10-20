<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 12.10.14
 * Time: 18:25
 */

register_shutdown_function( "fatal_handler" );

include("include.php");

$page_name = $_SERVER['SCRIPT_NAME'];

$dao = new DAO(null);

$text = $dao->getSysTextById(3);

$template = new Template($dao, 3, null, null, $page_name, $text, null, null, null);

include("template.html");

$dao->close();

function fatal_handler() {
    $errors = error_get_last();
    foreach($errors as $error) {
        print $error;
    }
}