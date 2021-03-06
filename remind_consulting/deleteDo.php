<?php
include_once "./common/_dbc.php";
include_once "./common/_lib.php";

$del_passwd = $_POST['del_passwd'];
$id = $_POST["id"];
$page = $_POST["page"];

try {

    $ptmt = $db->prepare("SELECT COUNT(*) as rt FROM `consulting` WHERE passwd = PASSWORD(:del_passwd) AND uid = :id");
    $ptmt->bindParam(":del_passwd", $del_passwd, PDO::PARAM_STR);
    $ptmt->bindParam(":id", $id, PDO::PARAM_INT);
    $ptmt->execute();
    $row = $ptmt->fetch(PDO::FETCH_ASSOC);
    $rt = $row['rt'];

    if ($rt == 0) { warn_back("비밀번호가 틀립니다."); }

    $dtmt = $db->prepare("DELETE FROM `consulting` WHERE uid = :id");
    $dtmt->bindParam(":id", $id, PDO::PARAM_INT);
    $result = $dtmt->execute();

    if ($result) {
        _goto("/remind_consulting/consulting.php?page=".$page);
    } else {
        print_r($db->errorInfo());
    }

} catch (PDOException $e) {
    print $e->getMessage();
    die();
}
?>