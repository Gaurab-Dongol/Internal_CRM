<?php

$connect = new PDO("mysql:host=localhost;dbname=Internal_CRM", "root", "root");

if($_POST["query"] != '')
{
	$search_array = explode(",", $_POST["query"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query = "
	SELECT * FROM Social_Media 
	WHERE Consultant IN (".$search_text.") 
	ORDER BY Consultant DESC
	";
}
else
{
	$query = "SELECT * FROM Social_Media ORDER BY Consultant DESC";
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
        <tr>
            <td>'.$row["Date"].'</td>
            <td>'.$row["First_Name"].'</td>
            <td>'.$row["Last_Name"].'</td>
            <td>'.$row["Appointment"].'</td>
			<td>'.$row["Email_Id"].'</td>
            <td>'.$row["Contact"].'</td>
            <td>'.$row["Location"].'</td>
			<td>'.$row["Enquiry"].'</td>
            <td>'.$row["Validation"].'</td>
            <td>'.$row["Current_Visa"].'</td>
            <td>'.$row["Notes"].'</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="5" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;


?>