<?php
include "../config/Database.php";
class InsertCountry extends Database{
    public function save()
    {
        if(isset($_POST["upload"])){
            $filename = $_FILES["currency"]["tmp_name"];
            if($_FILES["currency"]["size"] > 0){
                $file = fopen($filename, "r");
                $num = 0;
                while (($column = fgetcsv($file)) !== false) {
                    if($num == 0){
                        $num++;
                    }
                    else{
                        try{ 
                            $query = "INSERT INTO `countries` (`continent_code`, `currency_code`, `iso2_code`,
                             `is03_code`, `iso_numeric_code`,`fips_code`, `calling_code`,
                              `common_name`, `official_name`, `endonym`, `demonym`)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                            $stmt = $this->conn->prepare($query);
                            $stmt->execute([$column[0], $column[1], $column[2],$column[3],$column[4],$column[5]
                                    ,$column[6],$column[7],$column[8],$column[9],$column[10]]);
                        }catch(Exception $ex){
                            echo $ex->getMessage();
                        }

                    }
                    
                }
            }

            fclose($file);
            echo "Saved";
        }
    }
    
}

$obj = new InsertCountry();
$obj->save();
?>