  <!-- db 연결 -->
  <?php
  include_once "./common/_dbc.php";
  include_once "order_page.php";
  include_once "./inc/_head.php";
  ?>
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

          $stmt = $db->prepare("SELECT uid, subject, name, secure, regdate FROM `ordering` WHERE depth = 0 ORDER BY uid DESC LIMIT $start , $listSize");
          $stmt->execute();

          foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $uid = $row['uid'];
            $subject = $row['subject'];
            $name = $row['name'];
            $secure = $row['secure'];
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
      </tbody>
    </table>
    <div class="row">
      <!--------------------------페이지 넘기기 버튼------------------------------>
      <div class="col">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
            echo "<li class='page-item'>" . $prevBlock . "</li>";

            for ($i = $startPage; $i <= $endPage; $i++) {
              $active = $page == $i ? "disabled" : "";
              echo "<li class='page-item " . $active . "'><a class='page-link' href='./ordering.php?page=" . $i . "'>" . $i . "</a></li>";
            }

            echo "<li class='page-item'>" . $nextBlock . "</li>";
            ?>
          </ul>
        </nav>
      </div>
      <!--------------------------페이지 넘기기 버튼------------------------------>

      <!--------------------------글쓰기 버튼------------------------------>
      <div class="col">
        <a href="order_write.php" button class="btn btn-secondary">글쓰기</a>
      </div>
      <!--------------------------글쓰기 버튼------------------------------>
    </div>

    <!----------------------------------------게시판 글 목록------------------------------------>
  </div>

  <?php
  include_once "./inc/_modal.php";
  include_once "./inc/_tail.php";
  ?>