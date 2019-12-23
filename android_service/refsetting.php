<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

    
    $query_refSetting = "SELECT settingCode, charVal, remarks
					FROM refsetting";
    //ech
     $result_setting = mysqli_query($connection,$query_refSetting);  
     $settings=array();
       if (mysqli_num_rows($result_setting) != 0) {
        while($row_setting= mysqli_fetch_array($result_setting)){
                        $makeSettingArr['settingCode']=$row_setting['settingCode'];
			$makeSettingArr['charVal']=$row_setting['charVal'];
                        $makeSettingArr['remarks']=$row_setting['remarks'];
			array_push($response,$makeSettingArr);
        }	
        $settings["result"] = "true";
        $settings["refSettings"] = $response;
        echo json_encode($settings);
    } else {
        $response["result"] = "false";
    }

// echo json_encode($outlets);
//$createConnection->closeConnection();


