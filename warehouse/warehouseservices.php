<?php 

require('../dbconfig.php'); 
$finaloutput = array();
if(!$_POST) {
	$action = $_GET['action'];
}
else {
	$action = $_POST['action'];
}
switch($action){
    case 'update_warehouse_status':
        $finaloutput = update_warehouse_status();
    break;
    case 'job_shoot':
        $finaloutput = job_shoot();
    break;
    default:
        $finaloutput = array("infocode" => "INVALIDACTION", "message" => "Irrelevant action");
}

echo json_encode($finaloutput);

function update_warehouse_status(){
	global $dbc;
	$job_uuid = mysqli_real_escape_string($dbc, trim($_POST['job_uuid']));
	$warehouse_status = mysqli_real_escape_string($dbc, trim($_POST['warehouse_status']));
	$warehouseprev_status = mysqli_real_escape_string($dbc, trim($_POST['warehouseprev_status']));
	
	$query2 = "UPDATE warehouse SET warehouse_status = '$warehouse_status' WHERE job_uuid = '$job_uuid'";
	if(mysqli_query($dbc, $query2)){
		$inputs = array('job_uuid'=>$job_uuid,'log_type'=>'warehouse','status_from'=>$warehouseprev_status,'status_to'=>$warehouse_status,'errmsg'=> 'Error while logging warehouse - '.$warehouse_status);
		job_log_write($inputs);
		$output = array("infocode" => "WAREHOUSEUPDATED", "message" => "Warehouse status updated successfully");
	}else{
		writeerrorlog("\n".date('d-m-Y H:i:s')." : Error updating warehouse - {$warehouse_status} : ".$inputs['job_uuid']);
		$output = array("infocode" => "WAREHOUSEUPDATEFAILED", "message" => "Error occurred while updating Warehouse status");
	}
	return $output;
}

function job_log_write($inputs){
	global $dbc;
	$query = "INSERT INTO job_log (job_uuid, log_type, status_from, status_to, log_date) 
			VALUES ('{$inputs['job_uuid']}','{$inputs['log_type']}','{$inputs['status_from']}','{$inputs['status_to']}',CURRENT_TIMESTAMP())";
	if(!mysqli_query($dbc,$query)) {
		writeerrorlog("\n".date('d-m-Y H:i:s')." : {$inputs['errmsg']} : ".$inputs['job_uuid']);
	}
}

function writeerrorlog($text){
    $filename = "jobstatuserr.log";
    $fp = fopen($filename,"a");
    fwrite($fp, $text);
    fclose($fp);
}
