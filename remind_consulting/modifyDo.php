<?php
include_once "./common/_dbc.php";
include_once "./common/_lib.php";

$id = $_POST["id"];
$subject = $_POST['subject'];
$contents = $_POST['contents'];
$name = $_POST['name'];
$secure = $_POST['secure'];
$passwd = $_POST['passwd'];

if (empty($id)) { warn_back("잘못된 경로입니다."); }
if (empty($subject)) { warn_back("제목을 작성해 주세요."); }
if (empty($contents)) { warn_back("내용을 작성해 주세요."); }
if (empty($name)) { warn_back("이름을 작성해 주세요."); }
if (empty($passwd)) { warn_back("비밀번호를 작성해 주세요."); }

$isSecure = empty($secure) ? 0 : 1;

try {

    $ptmt = $db->prepare("SELECT COUNT(*) as rt FROM `consulting` WHERE passwd = PASSWORD(:passwd) AND uid = :id");
    $ptmt->bindParam(":passwd", $passwd, PDO::PARAM_STR);
    $ptmt->bindParam(":id", $id, PDO::PARAM_INT);
    $ptmt->execute();
    $row = $ptmt->fetch(PDO::FETCH_ASSOC);
    $rt = $row['rt'];

    if ($rt == 0) { warn_back("비밀번호가 틀립니다."); }

    $utmt = $db->prepare("UPDATE `consulting` SET subject=:subject, contents=:contents, name=:name, secure=:isSecure WHERE uid = :id");
    $utmt->bindParam(":subject", $subject, PDO::PARAM_STR);
    $utmt->bindParam(":contents", $contents, PDO::PARAM_STR);
    $utmt->bindParam(":name", $name, PDO::PARAM_STR);
    $utmt->bindParam(":isSecure", $isSecure, PDO::PARAM_INT);
    $utmt->bindParam(":id", $id, PDO::PARAM_INT);
    $result = $utmt->execute();

    if ($result) {
        _goto("/remind");
    } else {
        print_r($db->errorInfo());
    }

} catch (PDOException $e) {
    print $e->getMessage();
    die();
}
?>