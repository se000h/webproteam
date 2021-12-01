<?php
    session_start();
    include_once "./common/_dbc.php";
    include_once "./common/_lib.php";
    include_once "./inc/_head.php";

    /*  
        보안 강화 이전 도메인 추적 코드
        $refer = $_SERVER["HTTP_REFERER"];
        $addr_devider = explode("/", $refer);
        echo $addr_devider[sizeof($addr_devider) - 1];
    */
    
    $lockId = $_SESSION["aliver"];
    $id = $_GET["id"];
    $page = $_GET["page"];

    $vtmt = $db->prepare("UPDATE `consulting` SET view = view + 1 WHERE uid = :id");
    $vtmt->bindParam(":id", $id, PDO::PARAM_INT);
    $vtmt->execute();

    $stmt = $db->prepare("SELECT name, subject, contents, view, regdate, secure FROM `consulting` WHERE uid = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $row['name'];
    $subject = $row['subject'];
    $contents = $row['contents'];
    $view = $row['view'];
    $regdate = $row['regdate'];
    $secure = $row['secure'];

    if ((bool) $secure) {

        $checkId = "view".$id;
        $lockIcon = "<i class='material-icons'>lock</i>";

        if (empty($lockId) || $lockId != $checkId) {
            warn_back("잘못된 접근입니다.");
        }
    }

    $contents = nl2br($contents);

    $date = date_create($regdate);
    $_date = date_format($date, "Y년 m월 d일 H:i:s");
?>

<div class="container">
    <div class="content row">

        <?php include_once "./inc/_nav.php"; ?>

        <section class="view col-10">
   
            <div class="bb_subject">
                <?=$lockIcon?>
                <?=$subject?>
            </div>
            <div class="bb_name">
                <span>
                    <i class="material-icons">person</i>
                    <?=$name?>
                </span>
                <span class='right'>
                    <i class="material-icons">visibility</i>
                    <?=$view?>
                </span>
            </div>
            <div class="bb_contents">
                <?=$contents?>
            </div>
            <div class="bb_date">
                <span>
                    <i class="material-icons">date_range</i> 
                    <?=$_date?>
                </span>
            </div>

            <div class="bb_btns">
                <a href="./password.php?id=<?=$id?>&page=<?=$page?>&mode=modify" class='btn btn-secondary'>수정</a>
                <a href="./delete.php?id=<?=$id?>&page=<?=$page?>" class='btn btn-secondary'>삭제</a>
                <a href="./consulting.php?page=<?=$page?>" class='btn btn-secondary'>목록</a>
            </div>
         
        </section>

    </div>
</div>

<?php
   include_once "./inc/_tail.php";

/*
참고할 곳

PHP 게시판 :: 8화 view 작업. ( paging 오류 수정 ) >> https://blog.naver.com/psj9102/221349875379
PHP 게시판 :: 9화 버튼 및 password.php >> https://blog.naver.com/psj9102/221349875379
*/
?>