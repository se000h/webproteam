<?php
    session_start();
    include_once "./common/_dbc.php";
    include_once "./common/_lib.php";
    include_once "./inc/_head.php";

    $lockId = $_SESSION["aliver"];
    $id = $_GET["id"];
    $page = $_GET["page"];
    $checkBox = "";

    try {

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

            $checkId = "modify".$id;
            $checkBox = "checked";

            if (empty($lockId) || $lockId != $checkId) {
                warn_back("잘못된 접근입니다.");
            }
        }

    } catch (PDOException $e) {
        print $e->getMessage();
        die();
    }
?>

<div class="container">
    <div class="content row">

        <?php include_once "./inc/_nav.php"; ?>

        <section class="col-10">
            <form action="modifyDo.php" method="post">

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">이름</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="이름을 작성해주세요." value="<?=$name?>" required />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="subject" class="col-sm-2 col-form-label">제목</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="제목을 작성해주세요." value="<?=$subject?>" required />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="contents" class="col-sm-2 col-form-label">내용</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="contents" name="contents" rows="6" placeholder="내용을 작성해주세요." required><?=$contents?></textarea>
                    </div>
                </div>

                <!-- password 자리 -->
                <div class="form-group row">
                    <label for="passwd" class="col-sm-2 col-form-label">비밀번호</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="passwd" name="passwd" placeholder="비밀번호를 작성해주세요." required />
                        <div class="explain">
                            * 글 작성시 입력한 비밀번호를 입력해주세요.
                         </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="secure" id="secure" <?=$checkBox?> />
                            <label class="custom-control-label" for="secure">비공개 설정</label>
                        </div>

                        <div style="margin-top: 20px;">
                            <input type="hidden" name="id" value="<?=$id?>" />
                            <button type="submit" class="btn btn-primary">수정하기</button>
                            <a href="./" class="btn btn-secondary">목록</a>
                        </div>
                    </div>
                </div>
            </form>
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