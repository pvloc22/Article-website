<?php
class AuthorAttend{

    public $user_id;
    public $full_name;
    public $role;
    public $dateJoind;
    public function __construct($user_id, $full_name, $role, $dateJoind){
        $this->user_id = $user_id;
        $this->full_name = $full_name;
        $this->role = $role;
        $this->dateJoind = $dateJoind;
    }
}
class DetailPageModel
{
    public static function getInfoPaper($paperId)
    {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM PAPERS P JOIN CONFERENCES C ON P.conference_id = C.conference_id JOIN TOPICS T ON P.topic_id = T.topic_id WHERE P.paper_id = $paperId";
        $result = $mysqli->query($query);
        if ($result) {
            $row = mysqli_fetch_array($result);
        }
        return $row;
    }
    public static function getAuthorsAttendPapers($paperId)
    {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM PAPERS P JOIN PARTICIPATION PT ON PT.paper_id = P.paper_id JOIN AUTHORS A ON A.user_id = PT.author_id WHERE P.paper_id = $paperId GROUP BY PT.author_id";
        $result = $mysqli->query($query);
        $dstpp = array();
        if ($result) {
            foreach ($result as $row) {
                $dstpp[] = new AuthorAttend($row['user_id'], $row['full_name'], $row['role'], $row['date_added']);
            }
        }
        return $dstpp;
    }

}

?>