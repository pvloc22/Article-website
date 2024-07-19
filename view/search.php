<?php

$self = $_SERVER['PHP_SELF'];
$q = $_REQUEST['q'];
$pagesize = 5;
$currentpage = 1;
if (isset($_REQUEST["page"]))
    $currentpage = $_REQUEST["page"];

$start = ($currentpage - 1) * $pagesize;

$data = SearchModel::search($q, $start, $pagesize);
$numrow = SearchModel::countPapersSearch($q);
$numpage = ceil($numrow / ($pagesize * 1.0));


$response = '<div class="results-search">
<div class="filter">
    <h2>Kết quả tìm kiếm ' . "$q" . ' </h2>
    <form action="">
        <select name="filter-1" id="">
            <option value="">A</option>
            <option value="">B</option>
            <option value="">C</option>
            <option value="">D</option>
        </select>

        <select name="filter-2" id="">
            <option value="">A</option>
            <option value="">B</option>
            <option value="">C</option>
            <option value="">D</option>
        </select>

        <select name="filter-3" id="">
            <option value="">A</option>
            <option value="">B</option>
            <option value="">C</option>
            <option value="">D</option>
        </select>
        <input type="button" value="filter">
    </form>
</div>
<div class="result-items">
<div class="items">
';
if ($data) {
    foreach ($data as $paper) {
        $response = $response . "
    <a href=\"index.php?action=detail-item&paper-id=". $paper->paperId ."\" class=\"item-link\">
    <div class=\"item\">
        <h3> $paper->title;</h3>
        <div class=\"space-content\">
            <div class=\"space-content-author-name\">
                <p><span class=\"solid\">Authors: </span><span
                        class=\"detail-content\">$paper->listAuthor</span></p>
            </div>
            <div class=\"space-content-conference-name\">
                <p><span class=\"solid\">Conference: </span><span
                        class=\"detail-content\">$paper->conference</span></p>
            </div>
            <div class=\"space-content-conference-name\">
            <p><span class=\"solid\">Abbreviation: </span><span
                    class=\"detail-content\">$paper->abbreviation</span></p>
            </div>

            <div class=\"space-content-abstract\">
                <p><span class=\"solid\">Abstract: </span><span
                        class=\"detail-content\">$paper->abstract</span></p>
            </div>
        </div>
        <p class=\"date\">$paper->dateAdded</p>
    </div>
</a>
    ";
    }

} else {
    $response = $response . "
    <p> Không tìm thấy nội paper</p>
    ";
}

$response = $response . '        </div>
        </div>
    </div>
    <div class="pagination">
    ';
    
for ($i = 1; $i <= $numpage; $i++) {
    if ($i != $currentpage)
    $response = $response . "<a onclick=\"searchPaper($i)\">$i</a> ";
    else
    $response = $response . "<strong>$i</strong>";
}

//Style 
// if ($currentpage > 1) {
//     $page = $currentpage - 1;
//     $first = "<a href='$self?page=1'>[First]</a> ";
//     $prev = "<a href='$self?page=$page'>[Previous]</a> ";
// } else {
//     $first = "[First]";
//     $prev = "[Previous]";
// }


// if ($currentpage < $numpage) {
//     $page = $currentpage + 1;
//     $next = "<a href='$self?page=$page'>[Next]</a> ";
//     $last = "<a href='$self?page=$numpage'>[Last]</a> ";
// } else {
//     $next = "[Next]";
//     $last = "[Last]";
// }
// echo $first . $prev . " Page " . $currentpage . " " . $next . $last;



$response = $response .'

    </div>';

echo $response;
?>