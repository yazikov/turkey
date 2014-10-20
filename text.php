<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 12.10.14
 * Time: 18:24
 */
register_shutdown_function( "fatal_handler" );

include("include.php");

$page_name = $_SERVER['SCRIPT_NAME'];

$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$dao = new DAO(null);
$text = $dao->getTextById($id);

$template = new Template($dao, 4, null, null, $page_name, $text, null, null, null);

include("template.html");

$dao->close();

function fatal_handler() {
    $errors = error_get_last();
    foreach($errors as $error) {
        print $error;
    }
}