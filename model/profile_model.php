<?php
class Author{
    public $full_name;
    public $website;
    public $profile_json_text;
    public $image_path;
    public function __construct($full_name, $website, $profile_json_text, $image_path){
        $this->full_name = $full_name;
        $this->website = $website;
        $this->profile_json_text = $profile_json_text;
        $this->image_path = $image_path;
    }
}
class ProfileModel
{
    public static function getInformation($user_id)
    {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * from AUTHORS A  WHERE A.user_id = \"$user_id\""; 
        $result = $mysqli->query($query);
        if ($result) {
            foreach ($result as $row) {
                $response = new Author($row['full_name'], $row['website'], $row['profile_json_text'], $row['image_path']);
            }
        }
        $mysqli->close();
        return $response;
   }
   public static function getMypapers($user_id){
    $mysqli = connect();
    $mysqli->query("SET NAMES utf8");
    $query = "SELECT * FROM PAPERS P JOIN PARTICIPATION PT ON P.paper_id = PT.paper_id AND P.user_id = PT.author_id JOIN CONFERENCES C ON C.conference_id = P.conference_id WHERE p.user_id = \"$user_id\" ORDER BY PT.date_added DESC"; 
    $result = $mysqli->query($query);
    $response = array();
    if ($result) {
        foreach ($result as $rowPaper) {
            $dateTime = $rowPaper["date_added"];
            $date = new DateTime($dateTime);
            $response[] = new PaperItem($rowPaper["title"], $rowPaper["author_string_list"], $rowPaper["abstract"], $date->format('d-m-Y'), $rowPaper["name"], $rowPaper['abbreviation'], $rowPaper["paper_id"],);
        }
    }
    return $response;
   }
}
?>