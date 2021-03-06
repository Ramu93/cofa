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
    case 'addmodel_todate':
        $finaloutput = addmodel_todate();
    break;
    case 'job_shoot':
        $finaloutput = job_shoot();
    break;
    case 'update_design_status':
    	$finaloutput = update_design_status();
    	break;
    default:
        $finaloutput = array("infocode" => "INVALIDACTION", "message" => "Irrelevant action");
}

echo json_encode($finaloutput);

function update_design_status(){
	global $dbc;
	$job_uuid = mysqli_real_escape_string($dbc, trim($_POST['job_uuid']));
	$design_status = mysqli_real_escape_string($dbc, trim($_POST['job_status']));
	$designprev_status = mysqli_real_escape_string($dbc, trim($_POST['jobprev_status']));
	$endpoint = mysqli_real_escape_string($dbc, trim($_POST['endpoint']));
	$order_uuid = mysqli_real_escape_string($dbc, trim($_POST['order_uuid']));
	$employee_id_1 = mysqli_real_escape_string($dbc, trim($_POST['employee_id_1']));
	$employee_id_2 = mysqli_real_escape_string($dbc, trim($_POST['employee_id_2']));
	$employee1_status = mysqli_real_escape_string($dbc, trim($_POST['employee1_status']));
	$employee2_status = mysqli_real_escape_string($dbc, trim($_POST['employee2_status']));
	$remarks = mysqli_real_escape_string($dbc, trim($_POST['remarks']));
	
	$query2 = "UPDATE jobs SET job_status = '$design_status', design_employee_id_1='$employee_id_1', design_employee_id_2='$employee_id_2', design_employee1_status='$employee1_status', design_employee2_status='$employee2_status', remarks_design='$remarks'  WHERE job_uuid = '$job_uuid' ";
	if(mysqli_query($dbc, $query2)){
		$inputs = array('job_uuid'=>$job_uuid,'log_type'=>'design','status_from'=>$designprev_status,'status_to'=>$design_status,'errmsg'=> 'Error while logging design - '.$design_status);
		job_log_write($inputs);

		if($endpoint == 'edit_design'){
			$query3 = "SELECT job_status FROM jobs WHERE order_uuid='$order_uuid'";
			$result3 = mysqli_query($dbc, $query3);

			$order_job_statusflag = false;
			if(mysqli_num_rows($result3)>0){
	                while($row = mysqli_fetch_assoc($result3)){
	                	// check if a job is completed. if any oe of the job is not complete, the loop will break
	                	if($row['job_status'] == 'designcompleted'){
	                		$order_job_statusflag = true;
	                	} else {
	                		$order_job_statusflag = false;
	                		break;
	                	}
	                }
	        }

	        // update only if all jobs are completed
	        if($order_job_statusflag){
	        	$query4 = "UPDATE orders SET order_status='completed' WHERE order_uuid='$order_uuid'";
	        	mysqli_query($dbc, $query4);
	        }
		}

		$output = array("infocode" => "DESIGNUPDATED", "message" => "Design status updated successfully");
	}else{
		writeerrorlog("\n".date('d-m-Y H:i:s')." : Error updating design - {$design_status} : ".$inputs['job_uuid']);
		$output = array("infocode" => "DESIGNUPDATEFAILED", "message" => "Error occurred while updating design status");
	}
	return $output;
}


function addmodel_todate() {
    global $dbc;
	$shoot_date = mysqli_real_escape_string($dbc, trim($_POST['shoot_date']));
	$shoot_model = mysqli_real_escape_string($dbc, trim($_POST['shoot_model']));
	$shoot_room = mysqli_real_escape_string($dbc, trim($_POST['shoot_room']));
	
	$query = "INSERT INTO shoot_details (shoot_room, shoot_date, shoot_model, created_date) 
			VALUES ('$shoot_room','$shoot_date','$shoot_model',CURRENT_TIMESTAMP())";
	if(mysqli_query($dbc,$query)) {
		$output = array("infocode" => "MODELADDED", "message" => "Model added to the mentioned date Successfully");
	} else {
		//echo mysqli_error($dbc);
		$output = array("infocode" => "MODELADDFAILED", "message" => "Error occurred while adding model to date, please try again");
	}
	return $output;
}

function job_shoot() {
    global $dbc;
	$job_uuid = mysqli_real_escape_string($dbc, trim($_POST['job_uuid']));
	$shoot_date = mysqli_real_escape_string($dbc, trim($_POST['shoot_date']));
	$job_status = 'movedtoshoot';
	
	$query = "UPDATE jobs SET shoot_date='$shoot_date',job_status='$job_status' WHERE job_uuid = '$job_uuid'";
	if(mysqli_query($dbc,$query)) {
		if(update_warehouse($job_uuid)){
			$output = array("infocode" => "SHOOTMOVED", "message" => "Job moved to shoot");
			$inputs = array('job_uuid'=>$job_uuid,'log_type'=>'jobtoshoot','status_from'=>'created','status_to'=>'movedtoshoot', 'errmsg'=>'Error while logging jobtoshoot');
			job_log_write($inputs);
		}else{
			$output = array("infocode" => "SHOOTMOVEDWAREHOUSEFAILED", "message" => "Job moved to shoot, but unable to update warehouse status");
		}
	} else {
		$output = array("infocode" => "SHOOTMOVEFAILED", "message" => "Error occurred while moving to shoot");
	}
	return $output;
}

function update_warehouse($job_uuid){
	global $dbc;
	$query = "SELECT * FROM warehouse WHERE job_uuid = '$job_uuid'";
	$result = mysqli_query($dbc,$query);
	if(mysqli_num_rows($result)>0){
		$query2 = "UPDATE warehouse SET warehouse_status = 'notinformed' WHERE job_uuid = '$job_uuid'";
		if(mysqli_query($dbc,$query2)){
			$inputs = array('job_uuid'=>$job_uuid,'log_type'=>'warehouse','status_from'=>'','status_to'=>'notinformed','errmsg'=> 'Error while logging warehouse - not informed');
			job_log_write($inputs);
			return true;
		}else{
			writeerrorlog("\n".date('d-m-Y H:i:s')." : Error updating warehouse - notinformed : ".$inputs['job_uuid']);
			return false;
		}
	}else{
		$query3 = "INSERT INTO warehouse (job_uuid,warehouse_status) VALUES ('$job_uuid','notinformed')";
		if(mysqli_query($dbc,$query3)){
			$inputs = array('job_uuid'=>$job_uuid,'log_type'=>'warehouse','status_from'=>'','status_to'=>'notinformed','errmsg'=> 'Error while logging warehouse - not informed');
			job_log_write($inputs);
			return true;
		}else{
			writeerrorlog("\n".date('d-m-Y H:i:s')." : Error updating warehouse - notinformed : ".$inputs['job_uuid']);
			return false;
		}
	}
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
