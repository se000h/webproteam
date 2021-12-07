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

$vtmt = $db->prepare("UPDATE `ordering` SET view = view + 1 WHERE uid = :id");
$vtmt->bindParam(":id", $id, PDO::PARAM_INT);
$vtmt->execute();

$stmt = $db->prepare("SELECT name, subject, contents, view, regdate, secure, phonenum, email, emailadr, item, size, count  FROM `ordering` WHERE uid = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $row['name'];
$subject = $row['subject'];
$contents = $row['contents'];
$view = $row['view'];
$regdate = $row['regdate'];
$phonenum = $row['phonenum'];
$email = $row['email'];
$emailadr = $row['emailadr'];
$item = $row['item'];
$size = $row['size'];
$count = $row['count'];


if ((bool) $secure) {

    $checkId = "view" . $id;
    $lockIcon = "<i class='material-icons'>lock</i>";

    if (empty($lockId) || $lockId != $checkId) {
        warn_back("잘못된 접근입니다.");
    }
}

$contents = nl2br($contents);

$date = date_create($regdate);
$_date = date_format($date, "Y년 m월 d일 H:i:s");
?>

<div>
    <!----------------------------------------게시판 글 보기------------------------------------>
    <h2><?= $subject ?></h2>
    <br>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">성함</span>
        <input type="text" style="background-color: white" readonly class="form-control" aria-label="Username" placeholder="<?= $email ?>">
        <span class="input-group-text" id="basic-addon1">전화번호</span>
        <input type="text" style="background-color: white" readonly class="form-control" aria-label="Username" placeholder="<?= $phonenum ?>">
    </div>
    <div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">이메일</span>
            <input type="text" style="background-color: white" readonly class="form-control" aria-label="Username" placeholder="<?= $email ?>">
            <span class="input-group-text">@</span>
            <input type="text" style="background-color: white" readonly class="form-control" aria-label="Username" placeholder="<?= $emailadr ?>">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">인쇄품목</label>
            <input type="text" style="background-color: white" readonly class="form-control" aria-label="Server" placeholder="<?= $item ?>">
            <label class="input-group-text" for="inputGroupSelect01">책자 사이즈</label>
            <input type="text" style="background-color: white" readonly class="form-control" aria-label="Server" placeholder="<?= $size ?>">
        </div>
        <div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">수량</span>
                <input type="text" style="background-color: white" readonly class="form-control" placeholder="<?= $count ?>" aria-label="Username" aria-describedby="basic-addon1" placeholder="<?= $count ?>">
                <span class="input-group-text" id="basic-addon1">작성일</span>
                <input type="text" style="background-color: white" readonly class="form-control" aria-label="Username" placeholder="<?= $_date ?>">
            </div>
            <div class="form-floating">
                <textarea readonly class="form-control" style="height: 350px; background-color: white" id="floatingTextarea2"></textarea>
                <label for="floatingTextarea2"><?= $contents ?></label>
            </div>
        </div>
    </div>
    <br>
    <div class="bb_btns">
        <!-- <a href="./password.php?id=<?= $id ?>&page=<?= $page ?>&mode=modify" class='btn btn-secondary'>수정</a> -->
        <a href="./delete.php?id=<?= $id ?>&page=<?= $page ?>" class='btn btn-secondary'>삭제</a>
        <a href="./ordering.php?page=<?= $page ?>" class='btn btn-secondary'>목록</a>
    </div>
</div>
<?php
include_once "./inc/_tail.php";
?>