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
    case 'show_job_details':
        $finaloutput = show_job_details();
    break;
    case 'show_status':
    	$finaloutput = show_status();
    break;
    case 'show_completed_job_details':
    	$finaloutput = show_completed_job_details();
    break;
    
    default:
        $finaloutput = array("infocode" => "INVALIDACTION", "message" => "Irrelevant action");
}

echo $finaloutput;

function show_completed_job_details(){
	global $dbc;
	$order_uuid = mysqli_real_escape_string($dbc, trim($_POST['order_uuid']));
	$endpoint = trim($_POST['endpoint']);
	$query = "SELECT a.job_uuid, a.product_range, a.product_count, a.job_status, b.warehouse_status, a.product_remarks, a.created_date, a.completion_date, a.remarks_shoot, a.remarks_edit, a.remarks_design, a.remarks_catalog FROM jobs a, warehouse b  WHERE a.order_uuid='$order_uuid' AND a.job_uuid=b.job_uuid";
	$result = mysqli_query($dbc,$query);
	$statusflag = '';
	$status = array('created'=>0,'movedtoshoot'=>0, 'shootstarted'=>1, 'shootcompleted'=>2, 'editstarted'=>3, 'editcompleted'=>4, 'designstarted'=>5, 'designcompleted'=>6, 'catalogstarted'=>7, 'catalogcompleted'=>8);
	$status_endpoint = array('shoot'=>2 , 'edit_design'=>6, 'catalog'=>8);
	switch($endpoint){
		case 'shoot':
			$endstatus = $status_endpoint['shoot'];
		break;
		case 'edit_design':
			$endstatus = $status_endpoint['edit_design'];
		break;
		case 'catalog':
			$endstatus = $status_endpoint['catalog'];
		break;
	}
	$output = '<table class="table table-bordered" style="width: 900px"><thead><tr><th style="width: 10px">#</th><th>Job ID</th><th>Type</th><th>Count</th><th>Remarks</th><th>Created Date</th><th>Completed date</th><th>Status</th></tr></thead><tbody>';
    if(mysqli_num_rows($result)>0){
    	$sncount = 1;
    	while($row = mysqli_fetch_assoc($result)){

    		
    		switch($row['warehouse_status']){ // badge for warehouse_status
    			case 'notinformed':
    				$statusflag = '<span class="badge label-danger" data-toggle="tooltip" title="Warehouse not informed">W</span> ';
    			break;
    			case 'informed':
    				$statusflag = '<span class="badge label-warning" data-toggle="tooltip" title="Warehouse informed">W</span> ';
    			break;
    			case 'reached':
    				$statusflag = '<span class="badge label-success" data-toggle="tooltip" title="Warehouse reached">W</span> ';
    			break;
    		}

    		if($status[$row['job_status']] < $endstatus){
				$statusflag .= switch_badges($status[$row['job_status']]);
				$tmp = $endstatus - $status[$row['job_status']];
				if($tmp%2==0 && $status[$row['job_status']]!=0){
					$tmp = $tmp/2;
					switch ($endstatus) {
						case 6:	// end_point as edit_design
							$statusflag .= switch_red_badges($tmp);
						break;
						case 8:	//end_point as catalog
							$statusflag .= switch_red_badges($tmp+3);
						break;			
					}
				} else if($tmp%2==1 && $status[$row['job_status']]!=0){
					
					if($tmp==1){
						switch ($endstatus) {
							case 2: // produces grey badges when $endstatus=2 and current job_status=1
								$statusflag .= ' <span class="badge">E</span> <span class="badge">D</span> <span class="badge">C</span>';
							break;
							case 6: // produces grey badges when $endstatus=6 and current job_status=5
								$statusflag .= ' <span class="badge">C</span>';
							break;
						}
					}
					
					$tmp = ($tmp-1)/2;
					
					switch ($endstatus) {
						case 6:	// end_point as edit_design
							$statusflag .= switch_red_badges($tmp);
						break;
						case 8:	//end_point as catalog
							$statusflag .= switch_red_badges($tmp+3);
						break;			
					}
				} else if($status[$row['job_status']]==0){
					switch ($endstatus) {
						case 2:	// end_point as shoot
							$statusflag .= '<span class="badge label-danger" data-toggle="tooltip" title="Shoot not started">S</span> <span class="badge">E</span> <span class="badge">D</span> <span class="badge">C</span>';
						break;
						case 6:	// end_point as edit_design
							$statusflag .= '<span class="badge label-danger" data-toggle="tooltip" title="Shoot not started">S</span> <span class="badge label-danger" data-toggle="tooltip" title="Edit not started">E</span> <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge">C</span>';
						break;
						case 8:	//end_point as catalog
							$statusflag .= '<span class="badge label-danger" data-toggle="tooltip" title="Shoot not started">S</span> <span class="badge label-danger" data-toggle="tooltip" title="Edit not started">E</span> <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge label-danger">C</span>';
						break;			
					}				
				}
			} else if($status[$row['job_status']] == $endstatus){
				$statusflag .= switch_badges($endstatus);
				switch ($endstatus) {
						case 2:	// end_point as shoot
							$statusflag .= ' <span class="badge">E</span> <span class="badge">D</span> <span class="badge">C</span>';
						break;
						case 6:	// end_point as edit_design
							$statusflag .= ' <span class="badge">C</span>';
						break;
					}		
			}
    		$output .= '<tr><td>'.$sncount.'</td><td>'.$row['job_uuid'].'</td><td>'.$row['product_range'].'</td><td>'.$row['product_count'].'</td><td>'.$row['product_remarks'].'<br/>Shoot: '.$row['remarks_shoot'].'<br/>Edit: '.$row['remarks_edit'].' <br/>Design: '.$row['remarks_design'].' <br/>Catalog: '.$row['remarks_catalog'].'</td><td>'.date('d-m-Y',strtotime($row['created_date'])).'</td><td>'.date('d-m-Y',strtotime($row['completion_date'])).'</td><td>'.$statusflag.'</td></tr>';
    		$sncount++;
    	}
    }
    $output .= '</tbody></table>';

    return $output;
}

function show_job_details(){
	global $dbc;
	$order_uuid = mysqli_real_escape_string($dbc, trim($_POST['order_uuid']));
	$endpoint = trim($_POST['endpoint']);
	$query = "SELECT a.job_uuid, a.product_range, a.product_count, a.job_status, b.warehouse_status, a.product_remarks FROM jobs a, warehouse b  WHERE a.order_uuid='$order_uuid' AND a.job_uuid=b.job_uuid";
	$result = mysqli_query($dbc,$query);
	$statusflag = '';
	$status = array('created'=>0,'movedtoshoot'=>0, 'shootstarted'=>1, 'shootcompleted'=>2, 'editstarted'=>3, 'editcompleted'=>4, 'designstarted'=>5, 'designcompleted'=>6, 'catalogstarted'=>7, 'catalogcompleted'=>8);
	$status_endpoint = array('shoot'=>2 , 'edit_design'=>6, 'catalog'=>8);
	switch($endpoint){
		case 'shoot':
			$endstatus = $status_endpoint['shoot'];
		break;
		case 'edit_design':
			$endstatus = $status_endpoint['edit_design'];
		break;
		case 'catalog':
			$endstatus = $status_endpoint['catalog'];
		break;
	}
	$output = '<table class="table table-bordered"><thead><tr><th style="width: 10px">#</th><th>Job ID</th><th>Type</th><th>Count</th><th>Remarks</th><th>Status</th></tr></thead><tbody>';
    if(mysqli_num_rows($result)>0){
    	$sncount = 1;
    	while($row = mysqli_fetch_assoc($result)){

    		
    		switch($row['warehouse_status']){ // badge for warehouse_status
    			case 'notinformed':
    				$statusflag = '<span class="badge label-danger" data-toggle="tooltip" title="Warehouse not informed">W</span> ';
    			break;
    			case 'informed':
    				$statusflag = '<span class="badge label-warning" data-toggle="tooltip" title="Warehouse informed">W</span> ';
    			break;
    			case 'reached':
    				$statusflag = '<span class="badge label-success" data-toggle="tooltip" title="Warehouse reached">W</span> ';
    			break;
    		}

    		if($status[$row['job_status']] < $endstatus){
				$statusflag .= switch_badges($status[$row['job_status']]);
				$tmp = $endstatus - $status[$row['job_status']];
				if($tmp%2==0 && $status[$row['job_status']]!=0){
					$tmp = $tmp/2;
					switch ($endstatus) {
						case 6:	// end_point as edit_design
							$statusflag .= switch_red_badges($tmp);
						break;
						case 8:	//end_point as catalog
							$statusflag .= switch_red_badges($tmp+3);
						break;			
					}
				} else if($tmp%2==1 && $status[$row['job_status']]!=0){
					
					if($tmp==1){
						switch ($endstatus) {
							case 2: // produces grey badges when $endstatus=2 and current job_status=1
								$statusflag .= ' <span class="badge">E</span> <span class="badge">D</span> <span class="badge">C</span>';
							break;
							case 6: // produces grey badges when $endstatus=6 and current job_status=5
								$statusflag .= ' <span class="badge">C</span>';
							break;
						}
					}
					
					$tmp = ($tmp-1)/2;
					
					switch ($endstatus) {
						case 6:	// end_point as edit_design
							$statusflag .= switch_red_badges($tmp);
						break;
						case 8:	//end_point as catalog
							$statusflag .= switch_red_badges($tmp+3);
						break;			
					}
				} else if($status[$row['job_status']]==0){
					switch ($endstatus) {
						case 2:	// end_point as shoot
							$statusflag .= '<span class="badge label-danger" data-toggle="tooltip" title="Shoot not started">S</span> <span class="badge">E</span> <span class="badge">D</span> <span class="badge">C</span>';
						break;
						case 6:	// end_point as edit_design
							$statusflag .= '<span class="badge label-danger" data-toggle="tooltip" title="Shoot not started">S</span> <span class="badge label-danger" data-toggle="tooltip" title="Edit not started">E</span> <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge">C</span>';
						break;
						case 8:	//end_point as catalog
							$statusflag .= '<span class="badge label-danger" data-toggle="tooltip" title="Shoot not started">S</span> <span class="badge label-danger" data-toggle="tooltip" title="Edit not started">E</span> <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge label-danger">C</span>';
						break;			
					}				
				}
			} else if($status[$row['job_status']] == $endstatus){
				$statusflag .= switch_badges($endstatus);
				switch ($endstatus) {
						case 2:	// end_point as shoot
							$statusflag .= ' <span class="badge">E</span> <span class="badge">D</span> <span class="badge">C</span>';
						break;
						case 6:	// end_point as edit_design
							$statusflag .= ' <span class="badge">C</span>';
						break;
					}		
			}
    		$output .= '<tr><td>'.$sncount.'</td><td>'.$row['job_uuid'].'</td><td>'.$row['product_range'].'</td><td>'.$row['product_count'].'</td><td>'.$row['product_remarks'].'</td><td>'.$statusflag.'</td></tr>';
    		$sncount++;
    	}
    }
    $output.= '</tbody></table>';

    return $output;
}

function switch_red_badges($count){
	switch ($count) {
		// case 1 and case 2 for end_point=edit_design
		case 1:
			return ' <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge">C</span>';
		case 2:
			return ' <span class="badge label-danger" data-toggle="tooltip" title="Edit not started">E</span> <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge">C</span>';

		// case 4 to case 6 for end_point=catalog
		case 4:
			return ' <span class="badge label-danger" data-toggle="tooltip" title="Catalog not started">C</span>';
		case 5:
			return ' <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge label-danger" data-toggle="tooltip" title="Catalog not started">C</span>';
		case 6:
			return ' <span class="badge label-danger" data-toggle="tooltip" title="Edit not started">E</span> <span class="badge label-danger" data-toggle="tooltip" title="Design not started">D</span> <span class="badge label-danger" data-toggle="tooltip" title="Catalog not started">C</span>';
	}
}

function switch_badges($status){
	switch($status){
		case 1:
			return'<span class="badge label-warning data-toggle="tooltip" title="Shoot in progress"">S</span>';
		case 2:
			return'<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span>';
		case 3:
			return'<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span> <span class="badge label-warning" data-toggle="tooltip" title="Edit in progress">E</span>';
		case 4:
			return'<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span> <span class="badge label-success" data-toggle="tooltip" title="Edit completed">E</span>';
		case 5:
			return'<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span> <span class="badge label-success" data-toggle="tooltip" title="Edit completed">E</span> <span class="badge label-warning" data-toggle="tooltip" title="Design in progress">D</span>';
		case 6:
			return'<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span> <span class="badge label-success" data-toggle="tooltip" title="Edit completed">E</span> <span class="badge label-success" data-toggle="tooltip" title="Design completed">D</span>';
		case 7:
			return'<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span> <span class="badge label-success" data-toggle="tooltip" title="Edit completed">E</span> <span class="badge label-success" data-toggle="tooltip" title="Design completed">D</span> <span class="badge label-warning" data-toggle="tooltip" title="Catalog in progress">C</span>';
		case 8:
			return '<span class="badge label-success" data-toggle="tooltip" title="Shoot completed">S</span> <span class="badge label-success" data-toggle="tooltip" title="Edit completed">E</span> <span class="badge label-success" data-toggle="tooltip" title="Design completed">D</span> <span class="badge label-success" data-toggle="tooltip" title="Catalog completed">C</span>';
	}

}






