<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

//echo ''.$_REQUEST['mac_id'];

if (isset($_REQUEST['mac_id']) && $_REQUEST['mac_id'] != "") {
    $query_login = "SELECT Name, Address, Mobile, UserName, Password, Target, Code, Status, Prefix
					FROM User
					WHERE MacId='" .$_REQUEST['mac_id'] . "' AND status = '1' LIMIT 1";
				
    $result_login = mysqli_query($connection,$query_login);
    if (mysqli_num_rows($result_login) != 0) {
        $row_login = mysqli_fetch_row($result_login);
        $response["result"] = "TRUE";
        $response["Name"] = $row_login[0];
        $response["Address"] = $row_login[1];
        $response["Mobile"] = $row_login[2];
        $response["UserName"] = $row_login[3];
		$response["Password"] = $row_login[4];
                $response["Target"] = $row_login[5];
                $response["Code"] = $row_login[6];
                $response["Status"] = $row_login[7];
                $response["Prefix"] = $row_login[8];
    } else {
        $response["result"] = "FALSE";
    }
} else {
    $response["result"] = "FALSE";
}
echo json_encode($response);
//$createConnection->closeConnection();
?>
