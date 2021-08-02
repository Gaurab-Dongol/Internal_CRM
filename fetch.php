<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=Internal_CRM", "root", "root");

//require_once('config.php');
if ($_POST["query"] != '') {
	$search_array = explode(",", $_POST["query"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query = "
	SELECT * FROM OfficeHQ 
	WHERE Consultant IN (" . $search_text . ") 
	ORDER BY Consultant DESC
	";
} else {
	$query = "SELECT * FROM OfficeHQ ORDER BY Consultant DESC";
}
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if ($total_row > 0) {
	foreach ($result as $row) {
		$output .= '
        <tr>
			<td>' . $row["Client_Name"] . '</td>
			<td>' . $row["Email_Id"] . '</td>
			<td>' . $row["Contact"] . '</td>
			<td>' . $row["Enquiry"] . '</td>
            <td>' . $row["Notes"] . '</td>
            <td>' . $row["Status"] . '</td>
            <td>' . $row["Current_Visa"] . '</td>
            <td>' . $row["Appointment"] . '</td>
			<td>' . $row["MM_Update"] . '</td>
			<td>
			    <a href="#" class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal">
				<span class="fa fa-check"></span>
				</a>
				<a href="delete.php?id=' . $row["Id"] . '" class="btn btn-danger"><span class="fa fa-eraser"></span></a>
			</td>
		</tr>
		
		';
	}
} else {
	$output .= '
	<tr>
		<td colspan="5" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;
