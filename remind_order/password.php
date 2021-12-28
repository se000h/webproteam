<?php
    include_once "./inc/_head.php";

    $id = $_GET["id"];
    $page = $_GET['page'];
    $mode = $_GET['mode'];
?>

<div class="container">
    <div class="content row">

        <?php include_once "./inc/_nav.php"; ?>

        <section class="col-10">

            <form action="passwordDo.php" method="POST" id="passwd_form">
                <div class="pass_title">
                    패스워드를 입력해주세요.
                </div>

                <div class="pass_input">
                    <input type="password" name="bb_passwd" required />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <input type="hidden" name="page" value="<?=$page?>" />
                    <input type="hidden" name="mode" value="<?=$mode?>" />
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">확인</button>
                    <button type="button" class="btn btn-secondary" onClick="history.back(-1);">뒤로가기</button>
                    <a href="./" class="btn btn-secondary">목록</a>
                </div>

            </form>
        </section>
    </div>
</div>