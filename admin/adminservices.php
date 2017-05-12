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
    case 'enquiry_order':
        $finaloutput = enquiry_order();
    break;
    case 'job_shoot':
        $finaloutput = job_shoot();
    break;
    default:
        $finaloutput = array("infocode" => "INVALIDACTION", "message" => "Irrelevant action");
}

echo json_encode($finaloutput);

function getuniqueid(){
  global $dbc;
  $curr_m = date('m', time());
  $curr_Y = date('Y', time());
  $curr_count = 1;
  $prefix = "ORD_";

  $query = "SELECT enquiry_uuid FROM orders ORDER BY created_date DESC LIMIT 1";
  $result = mysqli_query($dbc, $query);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $previd = explode("_", $row['enquiry_uuid']);
    $previd_date = str_split($previd[1], 2);
    $previd_m = $previd_date[0];
    $previd_Y = $previd_date[1].$previd_date[2];
    $previd_count = intval($previd[2]);
    if($curr_Y == $previd_Y && $curr_m == $previd_m){
      $curr_count = $previd_count + 1;
    }
  }
  $uniqid = $prefix . $curr_m . $curr_Y . '_' . $curr_count;
  return $uniqid;
}


function enquiry_order() {
    global $dbc;
	$enquiry_uuid = mysqli_real_escape_string($dbc, trim($_POST['enquiry_uuid']));
	$order_uuid = getuniqueid();
	$order_status = 'created';
	
	$query = "INSERT INTO orders (order_uuid, enquiry_uuid, created_date, order_status) 
			VALUES ('$order_uuid','$enquiry_uuid',CURRENT_TIMESTAMP(),'$order_status')";
	if(mysqli_query($dbc,$query)) {
		$errcount = 0;
		$query2 = "SELECT * FROM marketing_enquiry WHERE enquiry_uuid = '$enquiry_uuid'";
		$result2 = mysqli_query($dbc,$query2);
		if(mysqli_num_rows($result2)>0){
			$row2 = mysqli_fetch_assoc($result2);
			$product_range = json_decode($row2['product_range']);
			$scount = 1;
			foreach ($product_range as $key => $value) {
				$job_uuid = str_replace('ENQ_','JOB_',$enquiry_uuid).'_'.$scount++;
				$query3 = "INSERT INTO jobs (job_uuid, order_uuid, product_range, product_count, product_remarks, job_status, created_date) 
				VALUES ('$job_uuid','$order_uuid','$key', '$value->count', '$value->remarks','$order_status',CURRENT_TIMESTAMP())";
				if(!mysqli_query($dbc,$query3)){
					$errcount++;
				}
			}
			if($errcount){
				$output = array("infocode" => "JOBFAILED", "message" => "Order created but Job creation failed");
			}else{
				$query4 = "UPDATE marketing_enquiry SET enquiry_status = 'converted' WHERE enquiry_uuid = '$enquiry_uuid'";
				if(mysqli_query($dbc,$query4)){
					$output = array("infocode" => "ORDERCREATED", "message" => "Order & Job created Successfully");
				}else{
					$output = array("infocode" => "ORDERCREATEDENQFAILED", "message" => "Order & Job created, but enquiry status updated failed");
				}
			}
		}else{
			$output = array("infocode" => "NOENQUIRY", "message" => "Enquiry doesnt exist!");
		}
	} else {
		$output = array("infocode" => "ORDERFAILED", "message" => "Error occurred while creating order");
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
