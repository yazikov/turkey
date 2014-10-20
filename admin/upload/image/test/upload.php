<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 19.10.14
 * Time: 19:12
 */

include("../../../../include.php");

$dao = new DAO(null);

if(isset($_POST['uploadfileid'])) {
    $id = $_POST['uploadfileid'];
    print 'id : '.$id.'<br/>';
    if (isset($_FILES['uploadfile'])) {
        print 'Имя файла: '.$_FILES['uploadfile']['name'].'<br/>';
        print 'Ошибка: '.$_FILES['uploadfile']['error'].'<br/>';
        print 'Временное имя файла: '.$_FILES["uploadFile"]["tmp_name"].'<br/>';
        if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], "images/catalog/".basename($_FILES["uploadFile"]["name"]))) {
            echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    print 'Не указан id недвижимости';
}