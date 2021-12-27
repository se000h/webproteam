<?php
$page = $_GET["page"];

if (empty($page)) { $page = 1; }

$ptmt = $db->prepare("SELECT COUNT(*) as size FROM `ordering` WHERE depth = 0");
$ptmt->execute();
$size = $ptmt->fetch(PDO::FETCH_ASSOC);
$nums = $size["size"];
 
$listSize = 10;
$blockSize = 10;

$start = ($page - 1) * $listSize;
$no = $nums - $start;

$totalListCount = ceil($nums/ $listSize);
$totalBlockCount = ceil($totalListCount/$blockSize);
$currentBlock = ceil($page / $blockSize);

$startPage = ($currentBlock - 1) * $blockSize + 1;

if ($currentBlock >= $totalBlockCount) {
    $endPage = $totalListCount;
} else {
    $endPage = $currentBlock * $blockSize;
}

if ($currentBlock > 1) {
    $prevBlock = "
        <a class='page-link' href='./?page=".($startPage - 1)."' aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
        </a>";
}

if ($currentBlock < $totalBlockCount) {
    $nextBlock = "
        <a class='page-link' href='./?page=".($endPage + 1)."' aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
        </a>";
}
?>