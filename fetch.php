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
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for="inputEmployee">Select Employee Name</label>
                                                    <select id="inputEmployee" name="Consultant" class="form-control">
                                                        <option selected>Choose from list...</option>
                                                        <option value="Somya Verma">Somya Verma</option>
                                                        <option value="Kathrine Lastname">Kathrine Lastname</option>
                                                        <option value="Upasana Lastname">Upasana Lastname</option>
                                                        <option value="Test employee">Test employee</option>
                                                    </select>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="inputFirstName">Client Name</label>
                                                        <input type="text" class="form-control" name="Name" placeholder="Client name">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" name="Email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Contact</label>
                                                    <input type="text" class="form-control" name="Contact" placeholder="Contact">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Enquiry</label>
                                                    <input type="text" class="form-control" name="Enquiry" placeholder="Enquiry">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress2">Note</label>
                                                    <input type="text" class="form-control" name="Note" placeholder="Note">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputCity">Status</label>
                                                    <input type="text" class="form-control" name="Status" placeholder="Status">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputCity">Current Visa</label>
                                                    <input type="text" class="form-control" name="CurrentVisa" placeholder="Current Visa">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputCity">Appointment</label>
                                                    <input type="text" class="form-control" name="Appointment" placeholder="Appointment">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputCity">MM_Update</label>
                                                    <input type="text" class="form-control" name="MM_Update" placeholder="MM_Update">
                                                </div>
                                    
                                                   <!-- <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <select id="inputState" class="form-control">
                                                            <option selected>Choose...</option>
                                                            <option value="">New South Wales</option>
                                                            <option value="">Queensland</option>
                                                            <option value="">Victoria</option>
                                                            <option value="">South Australia</option>
                                                            <option value="">Western Australia</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputZip">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
                                                    </div>-->
                                                </div>
                                                <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
												
                                            </form>
                                        </div>
                                        <div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
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
