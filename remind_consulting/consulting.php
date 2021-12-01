<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>인쇄마을 견적상담게시판</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="index.js"></script>

</head>

<body>
  <!-- db 연결 -->
  <?php
  include_once "./common/_dbc.php";
  include_once "con_page.php"
  ?>

  <div class="page" id="top">
    <!------------------------------------- 메뉴바 ------------------------------------->

    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <h2 href="index.html">인쇄마을</h2>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="introduce.html" class="nav-link px-2 link-dark">회사소개</a></li>
          <li><a href="index.html#photo" class="nav-link px-2 link-dark">인쇄품목</a></li>
          <li><a href="consulting.php" class="nav-link px-2 link-secondary">견적상담게시판</a></li>
          <li><a href="order.html" class="nav-link px-2 link-dark">주문게시판</a></li>
          <li><a href="map.html" class="nav-link px-2 link-dark">찾아오시는길</a></li>
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


    <!------------------------------------- 퀵메뉴 ------------------------------------->

    <!----------------------------------------게시판 글 목록------------------------------------>
    <div>
      <h2>견적상담게시판</h2>
      <br>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">순서</th>
            <th scope="col">제목</th>
            <th scope="col">작성자</th>
            <th scope="col">작성날짜</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($nums == 0) {
            echo "
            <tr>
                <th scope='row'></th>
                <td>게시글이 없습니다.</td>
            </tr>";
          } else {

            $stmt = $db->prepare("SELECT uid, subject, name, secure, view, regdate FROM `consulting` WHERE depth = 0 ORDER BY uid DESC LIMIT $start , $listSize");
            $stmt->execute();

            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
              $uid = $row['uid'];
              $subject = $row['subject'];
              $name = $row['name'];
              $secure = $row['secure'];
              $view = $row['view'];
              $regdate = $row['regdate'];

              $date = date_create($regdate);
              $_date = date_format($date, "Y-m-d");

              if ((bool) $secure) {
                // $subject_link = "<a href='password.php?page=".$page."&id=".$uid."&mode=view'>".$subject." <i class='material-icons'>lock</i> </a>";
                $subject_link = "<a href='#' data-ids='" . $uid . "' data-page='" . $page . "' class='modal-on' >" . $subject . " <i class='material-icons'>lock</i> </a>";
              } else {
                $subject_link = "<a href='view.php?page=" . $page . "&id=" . $uid . "'>" . $subject . "</a>";
              }

              echo "
                    <tr>
                      <th scope='row'>" . $no . "</th>
                        <td class='subject'>" . $subject_link . "</td>
                        <td class='name'>" . $name . "</td>
                        <td class='date'>" . $_date . "</td>
                    </tr>";

              $no--;
            }
          }
          ?>
          <!-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr> -->
        </tbody>
      </table>
      <div class="row">
        <!--------------------------페이지 넘기기 버튼------------------------------>
        <div class="col">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <!-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li> -->
              <?php
              echo "<li class='page-item'>" . $prevBlock . "</li>";

              for ($i = $startPage; $i <= $endPage; $i++) {
                $active = $page == $i ? "disabled" : "";
                echo "<li class='page-item " . $active . "'><a class='page-link' href='./consulting.php?page=" . $i . "'>" . $i . "</a></li>";
              }

              echo "<li class='page-item'>" . $nextBlock . "</li>";
              ?>
            </ul>
          </nav>
        </div>
        <!--------------------------페이지 넘기기 버튼------------------------------>

        <!--------------------------글쓰기 버튼------------------------------>
        <div class="col">
          <a href="con_write.php" button class="btn btn-secondary">글쓰기</a>
        </div>
        <!--------------------------글쓰기 버튼------------------------------>
      </div>

      <!----------------------------------------게시판 글 목록------------------------------------>
    </div>


    <!------------------------------------- 하단바 ------------------------------------->

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
  include_once "./inc/_modal.php";
  ?>
</body>

</html>