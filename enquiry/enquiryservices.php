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
    case 'delete_enquiry':
        $finaloutput = delete_enquiry();
    break;
    case 'get_employee_details':
        $finaloutput = get_employee_details();
    break;
    default:
        $finaloutput = array("infocode" => "INVALIDACTION", "message" => "Irrelevant action");
}

echo $finaloutput;


function delete_enquiry(){
	global $dbc;
	$enquiry_uuid = mysqli_real_escape_string($dbc, trim($_POST['enquiry_uuid']));
	$query = "DELETE FROM marketing_enquiry WHERE enquiry_uuid='$enquiry_uuid'";
    mysqli_query($dbc,$query);
    return 'Enquiry successfylly deleted.';
}

function get_employee_details(){
    global $dbc;
    $query = "SELECT * FROM employees";
    $result = mysqli_query($dbc,$query);
    $employees_options = "<label for=\"pickup_address\">Enquiry Created By</label><select class=\"form-control\" name=\"select_employee\" id=\"select_employee\"><option value=''>Select employee name</option>";
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $employees_options .= "<option value='".$row['employee_id']."'>".$row['employee_name']."</option>";
        }
    }
    return $employees_options.'</select>';
}

?>