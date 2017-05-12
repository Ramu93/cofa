<?php 

define('IMAGEPATH', 'enquiry_docs/');


require('dbconfig.php'); 
$finaloutput = array();
if(!$_POST) {
	$action = $_GET['action'];
}
else {
	$action = $_POST['action'];
}
switch($action){
    case 'add_enquiry':
        $finaloutput = addEnquiry();
    break;
    case 'update_enquiry':
        $finaloutput = updateEnquiry();
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
  $prefix = "ENQ_";

  $query = "SELECT enquiry_uuid FROM marketing_enquiry ORDER BY created_date DESC LIMIT 1";
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


function addEnquiry() {
    global $dbc;
	$enquiry_uuid = getuniqueid();
	$company_name = mysqli_real_escape_string($dbc, trim($_POST['company_name']));
	$contact_name = mysqli_real_escape_string($dbc, trim($_POST['contact_name']));
	$contact_email = mysqli_real_escape_string($dbc, trim($_POST['contact_email']));
	$contact_phone = mysqli_real_escape_string($dbc, trim($_POST['contact_phone']));
	$contact_address = mysqli_real_escape_string($dbc, trim($_POST['contact_address']));
	$pickup_address = mysqli_real_escape_string($dbc, trim($_POST['pickup_address']));
	$employee_id = mysqli_real_escape_string($dbc, trim($_POST['select_employee']));
	

	$tin_number = mysqli_real_escape_string($dbc, trim($_POST['tin_number']));
	$trademark = mysqli_real_escape_string($dbc, trim($_POST['trademark']));
	$cst_number = mysqli_real_escape_string($dbc, trim($_POST['cst_number']));
	$pan_number = mysqli_real_escape_string($dbc, trim($_POST['pan_number']));
	$cheque_numbers = mysqli_real_escape_string($dbc, trim($_POST['cheque_numbers']));
	$logo_url = mysqli_real_escape_string($dbc, trim($_POST['logo_url']));
	$project_type = mysqli_real_escape_string($dbc, trim($_POST['project_type']));

	$productarray = array('men','women','kids','tabletop','mannequin','others');
	$productrange_data = $mplist_array = array();
	foreach ($productarray as $key => $value) {
		if(isset($_POST['pr_check_'.$value])){
			$productrange_data[$value]['pr'] = 'Yes';
			$productrange_data[$value]['count'] = $_POST['pr_count_'.$value];
			$productrange_data[$value]['remarks'] = $_POST['pr_remarks_'.$value];
		}
	}
	$productrange_data = json_encode($productrange_data);
	
	$query = "SELECT * FROM marketplace_list";
    $result = mysqli_query($dbc,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
        	$mplist_array[] = $row['mp_name'];
        }
    }
	$mplist_data = array();
	foreach ($mplist_array as $key => $value) {
		if(isset($_POST['mp_check_'.$value])){
			$mplist_data[$value] = 'Yes';
		}
	}
	$mplist_data = json_encode($mplist_data);

	$noerrflag = true;

	if(isset($_FILES['tin_file']['name']) && isset($_FILES['trademark_file']['name']) && isset($_FILES['cst_file']['name']) && isset($_FILES['pan_file']['name']) && isset($_FILES['cheque_file']['name']) && isset($_FILES['logo_file']['name'])) {

        $tin_fname = 'tin_'.$company_name.'_'.time().'_'.$_FILES['tin_file']['name'];
        $trademark_fname = 'trademark_'.$company_name.'_'.time().'_'.$_FILES['trademark_file']['name'];
        $cst_fname = 'cst_'.$company_name.'_'.time().'_'.$_FILES['cst_file']['name'];
        $pan_fname = 'pan_'.$company_name.'_'.time().'_'.$_FILES['pan_file']['name'];
        $cheque_fname = 'cheque_'.$company_name.'_'.time().'_'.$_FILES['cheque_file']['name'];
        $logo_fname = 'logo_'.$company_name.'_'.time().'_'.$_FILES['logo_file']['name'];

        if(!move_uploaded_file($_FILES['tin_file']['tmp_name'],IMAGEPATH.$tin_fname) ||
        	!move_uploaded_file($_FILES['trademark_file']['tmp_name'],IMAGEPATH.$trademark_fname)||
        	!move_uploaded_file($_FILES['cst_file']['tmp_name'],IMAGEPATH.$cst_fname) ||
        	!move_uploaded_file($_FILES['pan_file']['tmp_name'],IMAGEPATH.$pan_fname) ||
        	!move_uploaded_file($_FILES['cheque_file']['tmp_name'],IMAGEPATH.$cheque_fname) ||
        	!move_uploaded_file($_FILES['logo_file']['tmp_name'],IMAGEPATH.$logo_fname) ) {
            $output = array("infocode" => "FILEUPLOADERR", "message" => "Unable to upload image, please try again!");
            $noerrflag = false;
        }
    }

    if($noerrflag){
	    	//Query
		$query = "INSERT INTO marketing_enquiry(enquiry_uuid,company_name,contact_name,contact_email,contact_phone,contact_address,pickup_address,tin_number,trademark,cst_number,pan_number,cheque_numbers,logo_url,product_range,marketplace_list,project_type,enquiry_date,enquiry_created_by,tin_fname,trademark_fname,cst_fname,pan_fname,cheque_fname,logo_fname) 
		VALUES ('$enquiry_uuid','$company_name','$contact_name','$contact_email','$contact_phone','$contact_address','$pickup_address','$tin_number','$trademark','$cst_number','$pan_number','$cheque_numbers','$logo_url','$productrange_data','$mplist_data','$project_type',CURDATE(),'$employee_id','$tin_fname','$trademark_fname','$cst_fname','$pan_fname','$cheque_fname','$logo_fname')";
		$result = mysqli_query($dbc,$query);
		if($result) {
			$output = array("infocode" => "INSERTSUCCESSFULLY", "message" => "New enquiry added successfully");
		}
		else {
			$output = array("infocode" => "UNSUCCESSFULL", "message" => "Something went worng");
		}
    }else{
        $output = array("infocode" => "FILEUPLOADERROR", "message" => "Error occurred while uploading files, Please try again!");
    }

	return $output;

	
}

function updateEnquiry() {
    global $dbc;
	$enquiry_uuid = mysqli_real_escape_string($dbc, trim($_POST['enquiry_uuid']));
	$company_name = mysqli_real_escape_string($dbc, trim($_POST['company_name']));
	$contact_name = mysqli_real_escape_string($dbc, trim($_POST['contact_name']));
	$contact_email = mysqli_real_escape_string($dbc, trim($_POST['contact_email']));
	$contact_phone = mysqli_real_escape_string($dbc, trim($_POST['contact_phone']));
	$contact_address = mysqli_real_escape_string($dbc, trim($_POST['contact_address']));
	$pickup_address = mysqli_real_escape_string($dbc, trim($_POST['pickup_address']));
	$employee_id = mysqli_real_escape_string($dbc, trim($_POST['select_employee']));

	$tin_number = mysqli_real_escape_string($dbc, trim($_POST['tin_number']));
	$trademark = mysqli_real_escape_string($dbc, trim($_POST['trademark']));
	$cst_number = mysqli_real_escape_string($dbc, trim($_POST['cst_number']));
	$pan_number = mysqli_real_escape_string($dbc, trim($_POST['pan_number']));
	$cheque_numbers = mysqli_real_escape_string($dbc, trim($_POST['cheque_numbers']));
	$logo_url = mysqli_real_escape_string($dbc, trim($_POST['logo_url']));
	$project_type = mysqli_real_escape_string($dbc, trim($_POST['project_type']));

	$productarray = array('men','women','kids','tabletop','mannequin','others');
	$productrange_data = $mplist_array = array();
	foreach ($productarray as $key => $value) {
		if(isset($_POST['pr_check_'.$value])){
			$productrange_data[$value]['pr'] = 'Yes';
			$productrange_data[$value]['count'] = $_POST['pr_count_'.$value];
			$productrange_data[$value]['remarks'] = $_POST['pr_remarks_'.$value];
		}
	}
	$productrange_data = json_encode($productrange_data);
	
	$query = "SELECT * FROM marketplace_list";
    $result = mysqli_query($dbc,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
        	$mplist_array[] = $row['mp_name'];
        }
    }
	$mplist_data = array();
	foreach ($mplist_array as $key => $value) {
		if(isset($_POST['mp_check_'.$value])){
			$mplist_data[$value] = 'Yes';
		}
	}
	$mplist_data = json_encode($mplist_data);


	$noerrflag = true;

	if(isset($_FILES['tin_file']['name']) && isset($_FILES['trademark_file']['name']) && isset($_FILES['cst_file']['name']) && isset($_FILES['pan_file']['name']) && isset($_FILES['cheque_file']['name']) && isset($_FILES['logo_file']['name'])) {

        $tin_fname = 'tin_'.$company_name.'_'.time().'_'.$_FILES['tin_file']['name'];
        $trademark_fname = 'trademark_'.$company_name.'_'.time().'_'.$_FILES['trademark_file']['name'];
        $cst_fname = 'cst_'.$company_name.'_'.time().'_'.$_FILES['cst_file']['name'];
        $pan_fname = 'pan_'.$company_name.'_'.time().'_'.$_FILES['pan_file']['name'];
        $cheque_fname = 'cheque_'.$company_name.'_'.time().'_'.$_FILES['cheque_file']['name'];
        $logo_fname = 'logo_'.$company_name.'_'.time().'_'.$_FILES['logo_file']['name'];

        if(!move_uploaded_file($_FILES['tin_file']['tmp_name'],IMAGEPATH.$tin_fname) ||
        	!move_uploaded_file($_FILES['trademark_file']['tmp_name'],IMAGEPATH.$trademark_fname)||
        	!move_uploaded_file($_FILES['cst_file']['tmp_name'],IMAGEPATH.$cst_fname) ||
        	!move_uploaded_file($_FILES['pan_file']['tmp_name'],IMAGEPATH.$pan_fname) ||
        	!move_uploaded_file($_FILES['cheque_file']['tmp_name'],IMAGEPATH.$cheque_fname) ||
        	!move_uploaded_file($_FILES['logo_file']['tmp_name'],IMAGEPATH.$logo_fname) ) {
            $output = array("infocode" => "FILEUPLOADERR", "message" => "Unable to upload image, please try again!");
            $noerrflag = false;
        }
    }

    if($noerrflag){

    	//Query
		$query = "UPDATE marketing_enquiry SET company_name='$company_name',contact_name='$contact_name',contact_email='$contact_email',contact_phone = '$contact_phone',contact_address = '$contact_address',pickup_address = '$pickup_address',tin_number = '$tin_number',trademark = '$trademark',cst_number = '$cst_number',cheque_numbers = '$cheque_numbers',logo_url = '$logo_url',product_range = '$productrange_data',marketplace_list = '$mplist_data',project_type='$project_type', enquiry_created_by = '$employee_id', tin_fname='$tin_fname', trademark_fname='$trademark_fname', cst_fname='$cst_fname', pan_fname='$pan_fname', cheque_fname='$cheque_fname', logo_fname='$logo_fname' WHERE enquiry_uuid = '$enquiry_uuid'";
		$result = mysqli_query($dbc,$query);
		if($result) {
			$output = array("infocode" => "INSERTSUCCESSFULLY", "message" => "Updated Successfully");
		}
		else {
			$output = array("infocode" => "UNSUCCESSFULL", "message" => "Something went worng");
		}

	
		
    }else{
        $output = array("infocode" => "FILEUPLOADERROR", "message" => "Error occurred while uploading files, Please try again!");
    }

    return $output;
	
}
