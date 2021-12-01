<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>인쇄마을 견적상담게시판 글쓰기</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="index.js"></script>

</head>

<body>
    <div class="page" id="top">

        <!------------------------------------- 메뉴바 ------------------------------------->

        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                    <h2 href="index.html">인쇄마을</h2>
                </a>

                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="./introduce.html" class="nav-link px-2 link-dark">회사소개</a></li>
                    <li><a href="index.html#photo" class="nav-link px-2 link-dark">인쇄품목</a></li>
                    <li><a href="./consulting.php" class="nav-link px-2 link-secondary">견적상담게시판</a></li>
                    <li><a href="./order.html" class="nav-link px-2 link-dark">주문게시판</a></li>
                    <li><a href="./map.html" class="nav-link px-2 link-dark">찾아오시는길</a></li>
            </header>
        </div>

        <!------------------------------------- 메뉴바 ------------------------------------->

        <!------------------------------------- 퀵메뉴 ------------------------------------->

        <div class="quickmenu">
            <ul>
                <li><a href="#">최근 본 상품</a></li>
                <li><a href="#">전화연결</a></li>
                <li><a href="#top">위로</a></li>
                <li><a href="#bottom">아래로</a></li>
            </ul>
        </div>
        <!----------------------------------------게시판 글 쓰기------------------------------------>
        <div>
            <h2>견적상담 글쓰기</h2>
            <br>
            <form action="con_writeDo.php" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">성함</span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="성함" aria-label="Username" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1">전화번호</span>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="전화번호" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">이메일</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
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
                        <button type="submit" class="btn btn-primary">등록하기</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- <div class="container">
            <div class="content row">
                <section class="col-10">
                    <form action="writeDo.php" method="post">

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">이름</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="이름을 작성해주세요." required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-sm-2 col-form-label">제목</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="제목을 작성해주세요." required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contents" class="col-sm-2 col-form-label">내용</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="contents" name="contents" rows="6" placeholder="내용을 작성해주세요." required></textarea>
                            </div>
                        </div>

                        // password 자리 
                        <div class="form-group row">
                            <label for="passwd" class="col-sm-2 col-form-label">비밀번호</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" id="passwd" name="passwd" placeholder="비밀번호를 작성해주세요." required>
                                <div class="explain">
                                    * 수정 및 삭제를 위해 반드시 필요합니다
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="secure" id="secure">
                                    <label class="custom-control-label" for="secure">비공개 설정</label>
                                </div>

                                <div style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-primary">등록하기</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div> -->

        <script>
            /*
그냥 이렇게 한다는 것만 알아두시기 바랍니다 ㅎㅎ;; 
password 는 꼭 필요한 요소였는데 거의 실수 때문에 번거로운 작업을 하게 되었네요.
이유는 "PHP 게시판 :: 6화 . 잘못된 코드 수정 및 리스트 마무리" 에서 확인 가능합니다.

$(document).ready(function () {

    var inputGroups = $(".form-group");
    var passLayout = ''+
        '<div class="form-group row" id="passForm">'+
           '<label for="passwd" class="col-sm-2 col-form-label">비밀번호</label>'+
           '<div class="col-sm-5">'+
            '<input type="password" class="form-control" id="passwd" name="passwd" placeholder="비밀번호를 작성해주세요." required>'+
           '</div>'+
        '</div>';

    $("#secure").on("click", function () {
        var checked = $(this).prop("checked");  
        if (checked) {
            $(inputGroups[2]).after(passLayout);

            // animation 효과 주기
            setTimeout(function () {
                $("#passForm").addClass("show");
            }, 100);

        } else {
            $("#passForm").remove();
        }
    })
})
 */
        </script>
        <div class="container" id="bottom">
            <footer class="py-3 my-4">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                </ul>
                <p class="text-center text-muted">
                    울산광역시 남구 달동 1285-11<br>
                    TEL - 052-227-3040 |
                    FAX - 052-227-3047 |
                    E-mail - 2273040@hanmail.net
                </p>
            </footer>
        </div>

        <!------------------------------------- 하단바 ------------------------------------->

    </div>
    <?php
    include_once "./inc/_tail.php";

    /*
참고할 곳

PHP 게시판 :: 3화 . write 글쓰기  >> https://blog.naver.com/psj9102/221346299575
PHP 게시판 :: 4화 . password UI 다루기 ( jQuery ) >> https://blog.naver.com/psj9102/221347807572
PHP 게시판 :: 5화 . writeDo 마무리 & list 뽑아내기 >> https://blog.naver.com/psj9102/221348493235
PHP 게시판 :: 실수를 했네요 (코드수정) >> https://blog.naver.com/psj9102/221348872549
*/
    ?>