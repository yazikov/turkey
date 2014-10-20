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

$active_page = 1;
if (isset($_GET['page'])) {
    $active_page = $_GET['page'];
}

$dao = new DAO(null);

$count = $dao->getTextCount();
$page_count = 0;
if ($count > 0) {
    $page_count = (int) ($count/5);
    if ($count % 5 != 0) {
        $page_count++;
    }
}
if ($active_page > $page_count) {
    $active_page = 1;
}

$texts = $dao->getTextPage($active_page);

$text = $dao->getSysTextById(4);

$template = new Template($dao, 4, $active_page, $page_count, $page_name, $text, $texts, null, null);

include("template.html");

$dao->close();

function fatal_handler() {
    $errors = error_get_last();
    foreach($errors as $error) {
        print $error;
    }
}