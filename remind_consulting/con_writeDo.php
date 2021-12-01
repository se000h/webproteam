<?php 
include_once "./common/_dbc.php";
include_once "./common/_lib.php";

$subject = $_POST['subject'];
$contents = $_POST['contents'];
$name = $_POST['name'];
$secure = $_POST['secure'];
$passwd = $_POST['passwd'];

if (empty($subject)) { warn_back("제목을 작성해 주세요."); }
if (empty($contents)) { warn_back("내용을 작성해 주세요."); }
if (empty($name)) { warn_back("이름을 작성해 주세요."); }
if (empty($passwd)) { warn_back("비밀번호를 작성해 주세요."); }

$isSecure = empty($secure) ? 0 : 1;
$regdate = date("Y-m-d H:i:s", time());

try {

    $ptmt = $db->prepare("SELECT PASSWORD(:passwd) as pw");
    $ptmt->bindParam(":passwd", $passwd, PDO::PARAM_STR);
    $ptmt->execute();
    $isPasswd = $ptmt->fetch(PDO::FETCH_ASSOC);
    $isPasswd = $isPasswd['pw'];

    $stmt = $db->prepare("INSERT INTO `consulting`(subject, contents, passwd, secure, name, regdate) VALUES(:subject, :contents, :isPasswd, :isSecure, :name, :regdate)");
    $stmt->bindParam(":subject", $subject, PDO::PARAM_STR);
    $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
    $stmt->bindParam(":isPasswd", $isPasswd, PDO::PARAM_STR);
    $stmt->bindParam(":isSecure", $isSecure, PDO::PARAM_INT);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":regdate", $regdate, PDO::PARAM_STR);
    $result = $stmt->execute();

    if ($result) {
        _goto("consulting.php");
    } else {
        print_r($db->errorInfo());
    }

} catch (PDOException $e) {
    print $e->getMessage();
    die();
}


/*
참고할 곳

PHP 게시판 :: 3화 . write 글쓰기  >> https://blog.naver.com/psj9102/221346299575
PHP 게시판 :: 5화 . writeDo 마무리 & list 뽑아내기 >> https://blog.naver.com/psj9102/221348493235
PHP 게시판 :: 실수를 했네요 (코드수정) >> https://blog.naver.com/psj9102/221348872549
*/
?>