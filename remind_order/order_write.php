<?php
include_once "./inc/_head.php";
?>
<!----------------------------------------게시판 글 쓰기------------------------------------>
<div>
    <h2>주문게시판 글쓰기</h2>
    <br>
    <form action="order_writeDo.php" method="post">
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
                <label class="input-group-text" for="inputGroupSelect01">인쇄품목</label>
                <select class="form-select" id="item" name="item">
                    <option selected>선택없음</option>
                    <option value="책자">책자</option>
                    <option value="브로슈어">브로슈어</option>
                    <option value="리플렛">리플렛</option>
                    <option value="포스터">포스터</option>
                    <option value="스티커">스티커</option>
                    <option value="표지판">표지판</option>
                    <option value="종이가방">종이가방</option>
                    <option value="각종 봉투">각종 봉투</option>
                    <option value="서식">서식</option>
                    <option value="명함">명함</option>
                </select>
                <label class="input-group-text" for="inputGroupSelect01">책자 사이즈</label>
                <select class="form-select" id="size" name="size">
                    <option selected>책자 선택하신 분들만 입력해주세요</option>
                    <option value="A5(148*210mm)">A5(148*210mm)</option>
                    <option value="A4(210*297mm)">A4(210*297mm)</option>
                    <option value="B5(182*257mm)">B5(182*257mm)</option>
                    <option value="16절(190*260mm)">16절(190*260mm)</option>
                </select>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">수량</span>
                    <input type="text" class="form-control" id="count" name="count" placeholder="ex) 200매" aria-label="Username" aria-describedby="basic-addon1">
                </div>
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
                <label for="floatingTextarea2">그 밖의 요구사항을 적어주십시오.</label>
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