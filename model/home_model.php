<?php
class Paper
{
    public $title;
    public $listAuthor;
    public $abstract;
    public $dateAdded;
    public function __construct($title, $listAuthor, $abstract, $dateAdded)
    {
        $this->title = $title;
        $this->listAuthor = $listAuthor;
        $this->abstract = $abstract;
        $this->dateAdded = $dateAdded;
    }
}
class ManagePapers
{
    public $topic_id;
    public $topic;
    public $papers = [];
    public function __construct($topic, $topic_id)
    {
        $this->topic_id = $topic_id;
        $this->topic = $topic;
    }
    public function addPaper(PaperItem $paper)
    {
        $this->papers[] = $paper;
    }

}
?>


<?php
class HomeModel
{
    public static function listAll()
    {
        $mysqli = connect();
        $dstpp = array();
        $mysqli->query("SET NAMES utf8");
        $query_topic = "SELECT T.topic_id, topic_name from Papers P JOIN TOPICS T ON P.conference_id = T.topic_id GROUP BY topic_name, T.topic_id ORDER BY T.topic_id ASC";
        $result_topic = $mysqli->query($query_topic);
        if ($result_topic) {
            foreach ($result_topic as $row) {
                $dstpp[] = new ManagePapers($row["topic_name"], $row["topic_id"]);
            }
        }
        foreach ($dstpp as $row) {
            $query = "SELECT * FROM PAPERS P JOIN PARTICIPATION PT ON P.paper_id = PT.paper_id AND P.user_id = PT.author_id JOIN CONFERENCES C ON C.conference_id = P.conference_id WHERE p.topic_id = {$row->topic_id} ORDER BY PT.date_added DESC";
            $result = $mysqli->query($query);
            if ($result) {
                foreach ($result as $rowPaper) {
                    $dateTime = $rowPaper["date_added"];
                    $date = new DateTime($dateTime);
                    $paper = new PaperItem($rowPaper["title"], $rowPaper["author_string_list"], $rowPaper["abstract"], $date->format('d-m-Y'), $rowPaper["name"], $rowPaper['abbreviation'], $rowPaper["paper_id"],);
                    $row->addPaper($paper);
                }
            }
        }

        $mysqli->close();
        return $dstpp;
    }
}
?>