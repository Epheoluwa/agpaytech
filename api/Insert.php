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
        
        
        //IMPORT ASSURED CUSTOMER WITH IT'S DETAILS NOTHING ABOUT PRODUCTS
public function import_asssured_list(){
	// exit;
	$bus_id = $_SESSION['business_id'];
	$data = [];
	$csv = $_FILES['CSV']; //get csv file
	$fileExt = end(explode('.',$csv['name'])); //get extension
	if($fileExt == 'csv'){//if extension is csv, proceed
		$tmpName = $csv['tmp_name'];//get data
		$file = fopen($tmpName, 'r');//read data
		while($row = fgetcsv($file)){ //get data and put into data array
			array_push($data, $row);
		}

		$count = 0;
		foreach($data as $key => $value){//foreach data coming get header keys to get remaining values
			$count++;
			if($count == 1){//for first count, get header keys
				$title = array_search("TITLE",$value);
				$f_name = array_search("FIRST NAME",$value);
				$o_name = array_search("OTHER NAME",$value);
				$l_name = array_search("LAST NAME",$value);
				$email = array_search("EMAIL",$value);
				$dob = array_search("DATE OF BIRTH",$value);
				$gender = array_search("GENDER",$value);
				$m_status = array_search("MARITAL STATUS",$value);
				$occupation = array_search("OCCUPATION",$value);
				$address = array_search("ADDRESS",$value);
				$phone = array_search("TELEPHONE",$value);
				$state = array_search("STATE",$value);
				$city = array_search("CITY",$value);
				
				
				//check if basic headers are existing
				if(empty($f_name) && empty($address) && empty($occupation) && empty($phone) && empty($dob) && empty($gender))
				{
					echo json_encode(['response' => 'Header do not correspond']);
					exit();
				}
			}else{
					
				$dob = date('Y-m-d', strtotime($value[$dob]));
						//insert into assured table.
						$sql_array = array(
							'title' => $value[$title],
							'firstname' => $value[$f_name],
							'lastname' => $value[$l_name],
							'other_name' => $value[$o_name],
							'email' => $value[$email],
							'address' => $value[$address],
							'city' => $value[$city],
							'state' => $value[$state],
							'postal_code' => '',
							'occupation' => $value[$occupation],
							'telephone' => $value[$phone],
							'dob' => $dob,
							'gender' => $value[$gender],
							'marital_status' => $value[$m_status],
							'active' => 1,
							'date_added' => date('Y-m-d'),
							'business_id' => $bus_id 
						);
									
					$submit_to_database = $this->tep_db_perform('assured', $sql_array);
					
					if($submit_to_database){
						echo json_encode(['status' => true]);
					}
			}
		}//end foreach
		exit;
	}else{
		echo json_encode(['response' => 'invalid file']);
	}	
}

}

$obj = new Insert();
$obj->save();
?>
