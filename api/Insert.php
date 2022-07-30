<?php
include "../config/Database.php";
class Insert extends Database{
        public function save(){
        if(isset($_POST["upload"])){
            $filename = $_FILES["currency"]["tmp_name"];
            if($_FILES["currency"]["size"] > 0){
                $file = fopen($filename, "r");
                $num = 0;
                while (($column = fgetcsv($file)) !== false) {
                    if($num == 0){
                        $num++;
                    }else{
                        try{
                            $query = "INSERT INTO `currencies` (`iso_code`, `iso_numeric_code`, `common_name`, `official_name`, `symbol`)
                            VALUES (?,?,?,?,?)";
                            $stmt = $this->conn->prepare($query);
                            $stmt->execute([$column[0], $column[1], $column[2],$column[3],$column[4]]);
                        }catch(Exception $ex){
                            echo $ex->getMessage();
                        }
                    }
                    
                }
            }

            fclose($file);
            echo "Currency Data Saved Succesfully";
        }
        }
}

$obj = new Insert();
$obj->save();
?>
