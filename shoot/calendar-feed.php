<?php 

require('../dbconfig.php');
$output = array();
$query = "SELECT * FROM shoot_details WHERE shoot_date >= CURDATE()";
$result = mysqli_query($dbc,$query);
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_assoc($result)){
		$e = array();
        $e['id'] = $row['shoot_id'];
        $e['title'] = $row['shoot_model'];
        $e['start'] = $row['shoot_date'];
        $e['end'] = $row['shoot_date'];
        $e['allDay'] = false;
        $output[] = $e;
	}

}else{
	$output = array();
}
echo json_encode($output);