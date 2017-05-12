<?php
	
	function hasPermission($rolename){
		if($_SESSION['userrole'][$rolename]=='yes'){
			return true;
		}
		return false;
	}

?>
