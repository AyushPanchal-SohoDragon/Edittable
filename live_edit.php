
##include_once("db_connect.php");
##$input = filter_input_array(INPUT_POST);
##if ($input['action'] == 'edit') {	
##	$update_field='';
##	if(isset($input['FirstName'])) {
##		$update_field.= "FirstName='".$input['FirstName']."'";
##	} else if(isset($input['LastName'])) {
##		$update_field.= "LastName='".$input['LastName']."'";
##	} else if(isset($input['CostRateMarkUp'])) {
##		$update_field.= "CostRateMarkUp='".$input['CostRateMarkUp']."'";
##	} 
##	if($update_field && $input['UserID']) {
##		$sql_query = "UPDATE UsersData SET $update_field WHERE UserID='" . $input['UserID'] . "'";	
##		mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));		
##	}
##}


<?php
include_once("config.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';
	if(isset($input['FirstName'])) {
		$update_field.= "FirstName='".$input['FirstName']."'";
	} else if(isset($input['LastName'])) {
		$update_field.= "LastName='".$input['LastName']."'";
	} else if(isset($input['CostRateMarkUp'])) {
		$update_field.= "CostRateMarkUp='".$input['CostRateMarkUp']."'";
	} 
	if($update_field && $input['UserID']) {
		$sql_query = "UPDATE UsersData SET $update_field WHERE UserID='" . $input['UserID'] . "'";	
		mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));		
	}
}





