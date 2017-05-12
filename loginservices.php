<?php
session_start();
require('dbconfig.php'); 
if(!$_POST) {
    $action = $_GET['action'];
}
else {
    $action = $_POST['action'];
}
switch($action){
    case 'login':
        $finaloutput = login();
    break;
}

echo json_encode($finaloutput);

function login(){
    global $dbc; 
    $output = array();
    $_SESSION['login']=false; 

    $login_id = mysqli_real_escape_string($dbc, trim($_POST['login_id']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

    $query="SELECT * FROM users WHERE login_id='".$login_id."'";
    $result=mysqli_query($dbc,$query);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        if(md5($password) == $row['password']){
            $_SESSION['login']=true; 
            $_SESSION['rolename'] =  $row['userrole'];  
            $_SESSION['username'] = $row['username'];        
            // $_SESSION['userrole'] = $row['userrole'];
            $query2 = "SELECT * FROM permissions WHERE userrole='".$row['userrole']."'";
            $result2 = mysqli_query($dbc,$query2);
            if(mysqli_num_rows($result2)>0){
                $row2=mysqli_fetch_assoc($result2);
                $temp_array = array();
                $temp_array = $row2;
                $_SESSION['userrole'] = $temp_array;
                //$output = HOMEURL.$row2['user_homepage'];
                $output = array("infocode" => "LOGINSUCCESS", "message" => HOMEURL.$row2['user_homepage']);
            }
        } else {
            //$output = "bootbox.alert('Wrong password!');";
            $output = array("infocode" => "INCORRECTPASSWORD", "message" => "Wrong password!");
        }
    } else {
        //$output = "bootbox.alert('Unknown user!');";
        $output = array("infocode" => "UNKNOWNUSER", "message" => "Unknown user!");
    }
    return $output;
}


?>