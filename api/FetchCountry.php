<?php
include "../config/Database.php";
class FetchCountry extends Database{

    public function getAll()
    {
            //define number of pages per page
            $perpage = 10;
            //get total number of pages
            $query = "SELECT COUNT(*) FROM `countries`";
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
            $query2 = "SELECT * FROM `countries` ORDER BY `id` LIMIT $offset, $limit";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute();
            $currencies = $stmt2->fetchAll();
            
            //search query start here
            if(isset($_GET["search"])){
                $query3 = "SELECT * FROM `countries` WHERE `common_name`  LIKE ? LIMIT $offset, $limit";
                $stmt3 = $this->conn->prepare($query3);
                $stmt3->execute(["%".$_GET["search"]."%"] );
                $currencies = $stmt3->fetchAll();
            }
            
            var_dump($currencies);  
    }

}

$obj = new FetchCountry();
$obj->getAll();
?>