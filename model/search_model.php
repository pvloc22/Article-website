<?php
class PaperItem
{
    // public $paperId;
    public $title;
    public $listAuthor;
    public $abstract;
    public $dateAdded;
    public $conference;
    public $abbreviation;
    public $paperId;
    public function __construct( $title, $listAuthor, $abstract, $dateAdded, $conference, $abbreviation, $paperId) 
    {
        // $this->paperId = $paperId;
        $this->title = $title;
        $this->listAuthor = $listAuthor;
        $this->abstract = $abstract;
        $this->dateAdded = $dateAdded;
        $this->conference = $conference;
        $this->abbreviation = $abbreviation;
        $this->paperId = $paperId;
    }
}

class SearchModel
{

    public static function search($keyword, $start, $pagesize)
    {
        $mysqli = connect();
        $dstpp = array();
        $mysqli->query("SET NAMES utf8");

        $query = "SELECT * FROM PAPERS P JOIN CONFERENCES C ON C.conference_id = P.conference_id JOIN PARTICIPATION PA ON p.paper_id = PA.paper_id WHERE P.user_id = PA.author_id AND (P.title LIKE \"%$keyword%\" OR P.author_string_list LIKE \"%$keyword%\" OR C.name  LIKE \"%$keyword%\" OR  C.abbreviation LIKE \"%$keyword%\" OR C.start_date LIKE \"%$keyword%\" OR C.Type LIKE \"%$keyword%\")LIMIT $start, $pagesize";
        $result = $mysqli->query($query);
        if ($result) {
            foreach ($result as $rowPaper) {
                $dateTime = $rowPaper["date_added"];
                $date = new DateTime($dateTime);
                $paper = new PaperItem($rowPaper["title"], $rowPaper["author_string_list"], $rowPaper["abstract"], $date->format('d-m-Y'), $rowPaper["name"], $rowPaper['abbreviation'], $rowPaper["paper_id"]);
                $dstpp[] = $paper;
            }
        }
        $mysqli->close();
        return $dstpp;
    }
    public static function countPapersSearch($keyword)
    {
        $mysqli = connect();
        $slpp = 0;
        $mysqli->query("SET NAMES utf8");

        $query = "SELECT count(*) NUMROW FROM PAPERS P JOIN CONFERENCES C ON C.conference_id = P.conference_id JOIN PARTICIPATION PA ON p.paper_id = PA.paper_id WHERE P.user_id = PA.author_id AND (P.title LIKE \"%$keyword%\" OR P.author_string_list LIKE \"%$keyword%\" OR C.name  LIKE \"%$keyword%\" OR  C.abbreviation LIKE \"%$keyword%\" OR C.start_date LIKE \"%$keyword%\" OR C.Type LIKE \"%$keyword%\")";
        $result = $mysqli->query($query);
        if ($result) {
            $row = mysqli_fetch_array($result);
            $slpp = $row["NUMROW"];
        }
        $mysqli->close();
        return $slpp;
    }
}
?>