<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include "../config/Database.php";
class Fetch extends Database{

 public function getAll(){
    //define number of data per page
    $perpage = 10;
    //get total number of pages
    $query = "SELECT COUNT(*) FROM `currencies`";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $entries = $stmt->fetchColumn();
    //totalnumber of pages available
    $totalpages = ceil($entries/ $perpage);

    //getting entry for current page
    $pagenow = isset($_GET["page"]) ? $_GET["page"] : 1;
    $offset = ($pagenow - 1) * $perpage;
    $limit = $perpage;

    //sql query fetch
    $query = "SELECT DISTINCT * FROM `currencies` ORDER BY `id` LIMIT $offset, $limit";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $currencies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //search query start here
    if(isset($_GET["search"])){
        $query3 = "SELECT * FROM `currencies` WHERE `common_name` LIKE ? LIMIT $offset, $limit";
        $stmt3 = $this->conn->prepare($query3);
        $stmt3->execute(["%".$_GET["search"]."%"]);
        $currencies = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    }
    $currencies["page"] = $pagenow;
    $currencies["Totalpage"] = $totalpages;
    // var_dump($currencies); 
    $response = json_encode($currencies);
    echo $response;
    
    return $response;   
    
 }

}

$obj = new Fetch();
$obj->getAll();
?>