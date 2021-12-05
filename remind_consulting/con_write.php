<?php
include_once "./inc/_head.php";
?>
<!----------------------------------------게시판 글 쓰기------------------------------------>
<div>
    <h2>견적상담 글쓰기</h2>
    <br>
    <form action="con_writeDo.php" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">제목</span>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="제목" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">성함</span>
            <input type="text" class="form-control" id="name" name="name" placeholder="성함" aria-label="Username" aria-describedby="basic-addon1">
            <span class="input-group-text" id="basic-addon1">전화번호</span>
            <input type="text" class="form-control" id="phonenum" name="phonenum" placeholder="01012345678" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">이메일</span>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" aria-label="Email">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="emailadr" name="emailadr" placeholder="gmail.com" aria-label="Server">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">비밀번호</span>
                <input type="text" class="form-control" id="passwd" name="passwd" placeholder="비밀번호를 작성해주세요" aria-label="Username">
            </div>
            <div class="checkbox">
                <input type="checkbox" class="custom-control-input" name="secure" id="secure">
                <label class="custom-control-label" for="secure">비공개 설정</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="contents" id="contents" style="height: 350px"></textarea>
                <label for="floatingTextarea2">원하시는 인쇄품목, 수량, 디자인 등을 적어주십시오</label>
            </div>
            <br>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-secondary">등록하기</button>
            </div>
        </div>
    </form>
</div>

<?php
include_once "./inc/_tail.php";
?>