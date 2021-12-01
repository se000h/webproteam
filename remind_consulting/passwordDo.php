<?php
    session_start();
    include_once "./common/_dbc.php";
    include_once "./common/_lib.php";

    $page = $_POST['page'];
    $id = $_POST['id'];
    $mode = $_POST["mode"];
    $bb_passwd = $_POST["bb_passwd"];

    if (empty($bb_passwd)) { warn_back("비밀번호를 작성해주세요."); }

    $stmt = $db->prepare("SELECT PASSWORD(:bb_passwd)");
    $stmt->bindParam(":bb_passwd", $bb_passwd, PDO::PARAM_STR);
    $stmt->execute();
    $pass = $stmt->fetch();

    $btmt = $db->prepare("SELECT passwd FROM `consulting` WHERE uid = :id");
    $btmt->bindParam(":id", $id, PDO::PARAM_INT);
    $btmt->execute();
    $pass_origin = $btmt->fetch(PDO::FETCH_ASSOC);

    if ($pass[0] != $pass_origin["passwd"]) {
        warn_back("비밀번호가 일치하지 않습니다.");
    }

    $cook = $mode.$id;
    $_SESSION["aliver"] = $cook;

    _goto("./".$mode.".php?page=".$page."&id=".$id)
?>