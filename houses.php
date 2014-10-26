<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 12.10.14
 * Time: 14:59
 */

register_shutdown_function( "fatal_handler" );

include("include.php");

$page_name = $_SERVER['REQUEST_URI'];

$active_page = 1;
if (isset($_GET['page'])) {
    $active_page = $_GET['page'];
}

$cond = "";

if (isset($_GET['country'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "c.id_country=".$_GET['country'];
}

if (isset($_GET['city'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.id_city=".$_GET['city'];
}

if (isset($_GET['type'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.type=".$_GET['type'];
}

if (isset($_GET['htype'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.id_house_type=".$_GET['htype'];
}

if (isset($_GET['minc'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.cost>=".$_GET['minc'];
}

if (isset($_GET['maxc'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.cost<=".$_GET['maxc'];
}

if (isset($_GET['minr'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.room_number>=".$_GET['minr'];
}

if (isset($_GET['maxr'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.room_number<=".$_GET['maxr'];
}

if (isset($_GET['minf'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.floor_number>=".$_GET['minf'];
}

if (isset($_GET['maxf'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.floor_number<=".$_GET['maxf'];
}

if (isset($_GET['p'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.parking=".$_GET['p'];
}

if (isset($_GET['s'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.swimming_pool=".$_GET['s'];
}

if (isset($_GET['f'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.furniture=".$_GET['f'];
}

if (isset($_GET['w'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.washer=".$_GET['w'];
}

if (isset($_GET['r'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.refrigerator=".$_GET['r'];
}

if (isset($_GET['k'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.kitchen=".$_GET['k'];
}

if (isset($_GET['sp'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.sport=".$_GET['sp'];
}

if (isset($_GET['b'])) {
    if ($cond != "") {
        $cond .= " and ";
    }
    $cond .= "h.bath=".$_GET['b'];
}

$dao = new DAO($cond);

$count = $dao->getHouseCount();

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

$houses = $dao->getHousePage($active_page);

$text = $dao->getSysTextById(2);

$template = new Template($dao, 2, $active_page, $page_count, $page_name, $text, null, null, $houses);

include("template.html");

$dao->close();

function fatal_handler() {
    $errors = error_get_last();
    foreach($errors as $error) {
        print $error;
    }
}