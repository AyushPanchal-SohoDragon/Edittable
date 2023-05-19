<?php
include 'config.php';
class CostRate
{
    public $id;
    public $amount;
    public $start_date;
    public $end_date;
    public $created_at;
    public $updated_at;
}
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Custom Field value
$searchByRole = $_POST['searchByRole'];


## Search 
$searchQuery = " ";
if($searchByRole != ''){
    $searchQuery .= " and (Roles like '%".$searchByRole."%' ) ";
}
if($searchValue != ''){
	$searchQuery .= " and (FirstName like '%".$searchValue."%' or 
        LastName like '%".$searchValue."%' or 
        Roles like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from UsersData");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from UsersData WHERE IsActive=1".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from UsersData WHERE IsActive=1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $amount=0;
    $values =  json_decode($row['CostRate'],true);
    if(count($values) ==1 )
    {
      $amount = $values{0}['amount'];
    }
    else if(count($values) >1)
    {
      foreach ($values as $item)
      {
        if(empty($item['end_date']))
        {
            $maxobj=$item;
        }
      }
      $amount = $maxobj['amount'];
    }
    else{
      $amount=0;
    }

    $data[] = array(
    		"UserID"=>$row['UserID'],
    		"FirstName"=>$row['FirstName'],
    		"LastName"=>$row['LastName'],
            "Email"=>$row['Email'],
            "Roles"=>$row['Roles'],
    		"TotalHours"=>$row['TotalHours'],
            "BillableHours"=>$row['BillableHours'],
            "DefaultHourlyRate"=>$row['DefaultHourlyRate'],
            "BillableAmount"=>$row['BillableAmount'],
            "CostRateMarkUp"=>$row['CostRateMarkUp'],
            "CostRate"=>$amount
            
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
