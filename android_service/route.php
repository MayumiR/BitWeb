<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

if (isset($_REQUEST['repcode']) && $_REQUEST['repcode'] != "") {
    
    //$query_route = "SELECT r.routecode, r.routename FROM route r";
    $query_route = "SELECT r.routecode, r.routename
					FROM route r, route_rep rr
					WHERE r.routecode = rr.routecode and r.status = '1' and
                                        rr.repcode = '" .$_REQUEST['repcode']."' limit 1";
    //add date ekak dala add date desc deela limit 1 karanna ona..one time can be go one route.thats why
     $result_route = mysqli_query($connection,$query_route);  
     $routes=array();
       if (mysqli_num_rows($result_route) != 0) {
        while($row_route= mysqli_fetch_array($result_route)){
                        $makeRouteArr['routecode']=$row_route['routecode'];
			$makeRouteArr['routename']=$row_route['routename'];
			array_push($response,$makeRouteArr);
        }	
        $routes["result"] = "true";
        $routes["routes"] = $response;
        echo json_encode($routes);
    } else {
        $response["result"] = "false";
    }
} else {
    $response["result"] = "false";
}
// echo json_encode($outlets);
//$createConnection->closeConnection();


