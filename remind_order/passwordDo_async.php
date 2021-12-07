<?php
session_start();
include_once "./common/_dbc.php";
include_once "./common/_lib.php";
/*
Error Type List
100 :: 클라이언트 
404 :: 서버 에러
500 :: 서버 다운
*/


$ids = $_POST['ids'];
$page = $_POST['page'];
$passwd = $_POST['passwd'];

try {

header('Content-Type: application/json');

if (empty($ids)) { echo json_encode(array("type" => 100 , "message" => "잘못된 경로입니다.")); exit; }
if (empty($passwd)) { echo json_encode(array("type" => 100 , "message" => "비밀번호를 작성해 주세요.")); exit; }

$stmt = $db->prepare("SELECT PASSWORD(:passwd)");
$stmt->bindParam(":passwd", $passwd, PDO::PARAM_STR);
$stmt->execute();
$pass = $stmt->fetch();

$btmt = $db->prepare("SELECT passwd FROM `ordering` WHERE uid = :ids");
$btmt->bindParam(":ids", $ids, PDO::PARAM_INT);
$btmt->execute();
$pass_origin = $btmt->fetch(PDO::FETCH_ASSOC);

if ($pass[0] != $pass_origin["passwd"]) {
    echo json_encode(array("type" => 100 , "message" => "비밀번호가 틀렸습니다."));
    exit;
}

$cook = "view".$ids;
$_SESSION["aliver"] = $cook;
echo json_encode(array("type" => 200 , "id" => $ids, "page" => $page));

} catch (PDOException $e) {
    print $e->getMessage();
    die();
}

?>