<?php

$host = "localhost";
$user = "root";
$passwd = "76063240";
$db = "web";

try {
    
    $db = new PDO('mysql:host='.$host.';dbname='.$db, $user, $passwd);

} catch (PDOException $e) {
    print $e->getMessage();
    die();
}

/*
참고할 곳
PHP 게시판 :: 1화 . DB 연동과 index 작성  >> https://blog.naver.com/psj9102/221343575258
PHP 게시판 :: 2화 . DB in & out  >> https://blog.naver.com/psj9102/221344974441
*/
?>