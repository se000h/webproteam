<?php 
include_once "./common/_dbc.php";
include_once "./common/_lib.php";

$subject = $_POST['subject'];
$contents = $_POST['contents'];
$name = $_POST['name'];
$secure = $_POST['secure'];
$passwd = $_POST['passwd'];
$phonenum = $_POST['phonenum'];
$email = $_POST['email'];
$emailadr = $_POST['emailadr'];

if (empty($subject)) { warn_back("전화번호를 작성해 주세요."); }
if (empty($phonenum)) { warn_back("전화번호를 작성해 주세요."); }
if (empty($contents)) { warn_back("내용을 작성해 주세요."); }
if (empty($name)) { warn_back("이름을 작성해 주세요."); }
if (empty($passwd)) { warn_back("비밀번호를 작성해 주세요."); }
if (empty($email)) { warn_back("이메일을 작성해 주세요."); }
if (empty($emailadr)) { warn_back("이메일을 작성해 주세요."); }

$isSecure = empty($secure) ? 0 : 1;
$regdate = date("Y-m-d H:i:s", time());

try {

    $ptmt = $db->prepare("SELECT PASSWORD(:passwd) as pw");
    $ptmt->bindParam(":passwd", $passwd, PDO::PARAM_STR);
    $ptmt->execute();
    $isPasswd = $ptmt->fetch(PDO::FETCH_ASSOC);
    $isPasswd = $isPasswd['pw'];

    $stmt = $db->prepare("INSERT INTO `consulting`(subject, contents, passwd, secure, name, regdate, phonenum, email, emailadr) VALUES(:subject, :contents, :isPasswd, :isSecure, :name, :regdate, :phonenum, :email, :emailadr)");
    $stmt->bindParam(":subject", $subject, PDO::PARAM_STR);
    $stmt->bindParam(":contents", $contents, PDO::PARAM_STR);
    $stmt->bindParam(":isPasswd", $isPasswd, PDO::PARAM_STR);
    $stmt->bindParam(":isSecure", $isSecure, PDO::PARAM_INT);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":regdate", $regdate, PDO::PARAM_STR);
    $stmt->bindParam(":phonenum", $phonenum, PDO::PARAM_INT);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":emailadr", $emailadr, PDO::PARAM_STR);
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

?>